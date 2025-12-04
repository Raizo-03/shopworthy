<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Shopping Cart</h1>
        
        <div v-if="!cart || cart.items.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
          <p class="text-slate-600 text-lg mb-4">Your cart is empty</p>
          <Link href="/shop">
            <Button variant="primary">Continue Shopping</Button>
          </Link>
        </div>
        
        <div v-else class="space-y-6">
          <Card>
            <div class="space-y-4">
              <div
                v-for="item in cart.items"
                :key="item.id"
                class="flex items-center space-x-4 pb-4 border-b border-slate-200 last:border-0 last:pb-0"
              >
                <div class="w-20 h-20 bg-slate-100 rounded-lg flex-shrink-0">
                  <img
                    v-if="item.product.image"
                    :src="`/storage/${item.product.image}`"
                    :alt="item.product.name"
                    class="w-full h-full object-cover rounded-lg"
                  />
                </div>
                
                <div class="flex-1">
                  <h3 class="font-semibold text-slate-900">{{ item.product.name }}</h3>
                  <p class="text-sm text-slate-600">{{ item.product.seller.shop_name }}</p>
                  <p class="text-lg font-bold text-indigo-600 mt-1">${{ item.product.price }}</p>
                </div>
                
                <div class="flex items-center space-x-2">
                  <input
                    v-model.number="item.quantity"
                    @change="updateQuantity(item.id, item.quantity)"
                    type="number"
                    min="1"
                    :max="item.product.stock"
                    class="w-16 px-2 py-1 rounded border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                  />
                  
                  <button
                    @click="removeItem(item.id)"
                    class="p-2 text-red-600 hover:bg-red-50 rounded transition-colors"
                  >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </Card>
          
          <Card>
            <div class="space-y-2">
              <div class="flex justify-between text-lg">
                <span class="font-medium text-slate-700">Total:</span>
                <span class="font-bold text-2xl text-indigo-600">${{ total.toFixed(2) }}</span>
              </div>
            </div>
            
            <div class="mt-6 flex space-x-4">
              <Link href="/shop" class="flex-1">
                <Button variant="secondary" class="w-full">Continue Shopping</Button>
              </Link>
              <Link href="/shop/checkout" class="flex-1">
                <Button variant="primary" class="w-full">Proceed to Checkout</Button>
              </Link>
            </div>
          </Card>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Card from '@/Components/Card.vue';
import Button from '@/Components/Button.vue';

defineProps({
  cart: Object,
  total: Number
});

const updateQuantity = (itemId, quantity) => {
  router.patch(`/shop/cart/${itemId}`, { quantity }, { preserveScroll: true });
};

const removeItem = (itemId) => {
  if (confirm('Remove this item from cart?')) {
    router.delete(`/shop/cart/${itemId}`, { preserveScroll: true });
  }
};
</script>
