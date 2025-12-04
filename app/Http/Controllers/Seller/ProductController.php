<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Auth::guard('seller')->user()
            ->products()
            ->with('category')
            ->latest()
            ->paginate(10);

        return Inertia::render('Seller/Products/Index', [
            'products' => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        
        return Inertia::render('Seller/Products/Create', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        $validated['seller_id'] = Auth::guard('seller')->id();
        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Product::create($validated);

        return redirect('/seller/products')->with('success', 'Product created successfully');
    }

    public function edit($id)
    {
        $product = Auth::guard('seller')->user()
            ->products()
            ->findOrFail($id);

        $categories = Category::all();

        return Inertia::render('Seller/Products/Edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Auth::guard('seller')->user()
            ->products()
            ->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);
        }

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect('/seller/products')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Auth::guard('seller')->user()
            ->products()
            ->findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully');
    }
}
