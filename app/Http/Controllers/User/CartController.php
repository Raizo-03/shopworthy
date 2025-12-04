<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart()->with(['items.product.seller'])->first();
        
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        return Inertia::render('Shop/Cart', [
            'cart' => $cart,
            'total' => $cart->getTotal()
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available']);
        }

        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = Cart::create(['user_id' => Auth::id()]);
        }

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return back()->withErrors(['error' => 'Not enough stock available']);
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        if ($cartItem->product->stock < $request->quantity) {
            return back()->withErrors(['error' => 'Not enough stock available']);
        }

        $cartItem->update(['quantity' => $request->quantity]);

        return back()->with('success', 'Cart updated');
    }

    public function remove($itemId)
    {
        $cartItem = CartItem::where('id', $itemId)
            ->whereHas('cart', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->firstOrFail();

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart');
    }
}
