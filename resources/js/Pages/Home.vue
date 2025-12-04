<template>
  <Layout>
    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 min-h-screen">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center">
          <h1 class="text-5xl font-bold text-slate-900 mb-6">
            Welcome to <span class="text-indigo-600">ShopWorthy</span>
          </h1>
          <p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto">
            Your one-stop marketplace for quality products. Shop from trusted sellers or start your own business.
          </p>
          
          <div class="flex justify-center space-x-4">
            <Link href="/user/login">
              <Button variant="primary" class="text-lg px-8 py-4">
                Start Shopping
              </Button>
            </Link>
            <Link href="/seller/login">
              <Button variant="outline" class="text-lg px-8 py-4">
                Become a Seller
              </Button>
            </Link>
          </div>
        </div>
        
        <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8">
          <div class="bg-white p-8 rounded-xl border border-slate-200">
            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Wide Selection</h3>
            <p class="text-slate-600">Browse thousands of products from various categories.</p>
          </div>
          
          <div class="bg-white p-8 rounded-xl border border-slate-200">
            <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Secure Shopping</h3>
            <p class="text-slate-600">Shop with confidence with our secure checkout process.</p>
          </div>
          
          <div class="bg-white p-8 rounded-xl border border-slate-200">
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
              </svg>
            </div>
            <h3 class="text-lg font-semibold text-slate-900 mb-2">Fast Delivery</h3>
            <p class="text-slate-600">Quick and reliable shipping on all orders.</p>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Button from '@/Components/Button.vue';
</script>
