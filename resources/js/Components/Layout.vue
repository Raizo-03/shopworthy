<template>
  <div>
    <div class="bg-white border-b border-slate-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
          <Link href="/" class="text-xl font-bold text-indigo-600">ShopWorthy</Link>
          
          <nav class="flex items-center space-x-6">
            <template v-if="$page.props.auth.user">
              <Link href="/shop" class="text-slate-700 hover:text-indigo-600 transition-colors">Shop</Link>
              <Link href="/shop/cart" class="text-slate-700 hover:text-indigo-600 transition-colors">Cart</Link>
              <Link href="/shop/orders" class="text-slate-700 hover:text-indigo-600 transition-colors">Orders</Link>
              <Link href="/user/logout" method="post" as="button" class="text-slate-700 hover:text-indigo-600 transition-colors">
                Logout
              </Link>
            </template>
            <template v-else-if="$page.props.auth.seller">
              <Link href="/seller/dashboard" class="text-slate-700 hover:text-indigo-600 transition-colors">Dashboard</Link>
              <Link href="/seller/products" class="text-slate-700 hover:text-indigo-600 transition-colors">Products</Link>
              <Link href="/seller/orders" class="text-slate-700 hover:text-indigo-600 transition-colors">Orders</Link>
              <Link href="/seller/logout" method="post" as="button" class="text-slate-700 hover:text-indigo-600 transition-colors">
                Logout
              </Link>
            </template>
            <template v-else>
              <Link href="/user/login" class="text-slate-700 hover:text-indigo-600 transition-colors">Shop</Link>
              <Link href="/seller/login" class="text-slate-700 hover:text-indigo-600 transition-colors">Sell</Link>
            </template>
          </nav>
        </div>
      </div>
    </div>
    
    <div v-if="$page.props.flash.success" class="bg-emerald-50 border-b border-emerald-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <p class="text-emerald-800">{{ $page.props.flash.success }}</p>
      </div>
    </div>
    
    <div v-if="$page.props.flash.error" class="bg-red-50 border-b border-red-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <p class="text-red-800">{{ $page.props.flash.error }}</p>
      </div>
    </div>
    
    <main>
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
