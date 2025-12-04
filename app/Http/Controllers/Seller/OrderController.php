<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $seller = Auth::guard('seller')->user();

        $orders = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $seller->id)
            ->latest()
            ->paginate(20);

        return Inertia::render('Seller/Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function show($orderId)
    {
        $seller = Auth::guard('seller')->user();

        $order = Order::with(['items' => function($q) use ($seller) {
            $q->where('seller_id', $seller->id)->with('product');
        }, 'user'])
        ->findOrFail($orderId);

        // Check if seller has items in this order
        if ($order->items->count() === 0) {
            abort(403, 'Unauthorized access to this order');
        }

        return Inertia::render('Seller/Orders/Show', [
            'order' => $order
        ]);
    }
}
