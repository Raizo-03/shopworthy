<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with(['items.product.seller'])->first();
        
        if (!$cart || $cart->items->count() === 0) {
            return redirect('/shop')->with('error', 'Your cart is empty');
        }

        return Inertia::render('Shop/Checkout', [
            'cart' => $cart,
            'total' => $cart->getTotal()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zip' => 'required|string|max:10',
        ]);

        $cart = Auth::user()->cart()->with(['items.product'])->first();

        if (!$cart || $cart->items->count() === 0) {
            return back()->withErrors(['error' => 'Your cart is empty']);
        }

        DB::transaction(function () use ($validated, $cart) {
            // Check stock availability
            foreach ($cart->items as $item) {
                if ($item->product->stock < $item->quantity) {
                    throw new \Exception('Insufficient stock for ' . $item->product->name);
                }
            }

            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'total' => $cart->getTotal(),
                'status' => 'pending',
                'shipping_name' => $validated['shipping_name'],
                'shipping_email' => $validated['shipping_email'],
                'shipping_phone' => $validated['shipping_phone'],
                'shipping_address' => $validated['shipping_address'],
                'shipping_city' => $validated['shipping_city'],
                'shipping_state' => $validated['shipping_state'],
                'shipping_zip' => $validated['shipping_zip'],
            ]);

            // Create order items and update stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'seller_id' => $item->product->seller_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);

                // Decrease stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();
        });

        return redirect('/shop/orders')->with('success', 'Order placed successfully!');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->with(['items.product'])->latest()->paginate(10);

        return Inertia::render('Shop/Orders', [
            'orders' => $orders
        ]);
    }
}
