<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $seller = Auth::guard('seller')->user();

        // Get statistics
        $totalProducts = $seller->products()->count();
        $activeProducts = $seller->products()->where('is_active', true)->count();
        
        $totalOrders = OrderItem::where('seller_id', $seller->id)->distinct('order_id')->count();
        
        $totalRevenue = OrderItem::where('seller_id', $seller->id)
            ->sum(DB::raw('quantity * price'));

        // Recent orders
        $recentOrders = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $seller->id)
            ->latest()
            ->take(10)
            ->get();

        // Sales by month (last 6 months)
        $monthlySales = OrderItem::where('seller_id', $seller->id)
            ->select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
                DB::raw('SUM(quantity * price) as total')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top products
        $topProducts = OrderItem::with('product')
            ->where('seller_id', $seller->id)
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'), DB::raw('SUM(quantity * price) as revenue'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return Inertia::render('Seller/Dashboard', [
            'stats' => [
                'totalProducts' => $totalProducts,
                'activeProducts' => $activeProducts,
                'totalOrders' => $totalOrders,
                'totalRevenue' => $totalRevenue,
            ],
            'recentOrders' => $recentOrders,
            'monthlySales' => $monthlySales,
            'topProducts' => $topProducts,
        ]);
    }
}
