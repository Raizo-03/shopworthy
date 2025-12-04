<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">My Orders</h1>
        
        <div v-if="orders.data.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
          <p class="text-slate-600 text-lg">No orders yet</p>
        </div>
        
        <div v-else class="space-y-4">
          <Card
            v-for="order in orders.data"
            :key="order.id"
          >
            <div class="flex justify-between items-start mb-4">
              <div>
                <h3 class="font-semibold text-lg">Order #{{ order.order_number }}</h3>
                <p class="text-sm text-slate-600">{{ new Date(order.created_at).toLocaleDateString() }}</p>
              </div>
              <span
                :class="[
                  'px-3 py-1 rounded-full text-sm font-medium',
                  order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                  order.status === 'processing' ? 'bg-blue-100 text-blue-800' :
                  order.status === 'shipped' ? 'bg-purple-100 text-purple-800' :
                  order.status === 'delivered' ? 'bg-emerald-100 text-emerald-800' :
                  'bg-red-100 text-red-800'
                ]"
              >
                {{ order.status.charAt(0).toUpperCase() + order.status.slice(1) }}
              </span>
            </div>
            
            <div class="space-y-2 mb-4">
              <div v-for="item in order.items" :key="item.id" class="flex justify-between text-sm">
                <span class="text-slate-600">{{ item.product.name }} x{{ item.quantity }}</span>
                <span class="font-medium">${{ (item.price * item.quantity).toFixed(2) }}</span>
              </div>
            </div>
            
            <div class="border-t border-slate-200 pt-4">
              <div class="flex justify-between">
                <span class="font-semibold">Total:</span>
                <span class="text-xl font-bold text-indigo-600">${{ order.total }}</span>
              </div>
            </div>
          </Card>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '@/Components/Layout.vue';
import Card from '@/Components/Card.vue';

defineProps({
  orders: Object
});
</script>
