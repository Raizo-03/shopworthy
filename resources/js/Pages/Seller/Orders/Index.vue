<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">My Orders</h1>
        
        <div v-if="orders.data.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
          <p class="text-slate-600 text-lg">No orders yet</p>
        </div>
        
        <div v-else class="bg-white rounded-xl border border-slate-200 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Order #</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Product</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Customer</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Quantity</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Total</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Status</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Date</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200">
                <tr v-for="orderItem in orders.data" :key="orderItem.id">
                  <td class="px-6 py-4 font-medium text-slate-900">{{ orderItem.order.order_number }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ orderItem.product.name }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ orderItem.order.user.name }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ orderItem.quantity }}</td>
                  <td class="px-6 py-4 font-medium text-slate-900">${{ (orderItem.price * orderItem.quantity).toFixed(2) }}</td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'inline-block px-2 py-1 rounded-full text-xs font-medium',
                        orderItem.order.status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                        orderItem.order.status === 'processing' ? 'bg-blue-100 text-blue-800' :
                        orderItem.order.status === 'shipped' ? 'bg-purple-100 text-purple-800' :
                        orderItem.order.status === 'delivered' ? 'bg-emerald-100 text-emerald-800' :
                        'bg-red-100 text-red-800'
                      ]"
                    >
                      {{ orderItem.order.status.charAt(0).toUpperCase() + orderItem.order.status.slice(1) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-slate-600">{{ new Date(orderItem.created_at).toLocaleDateString() }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import Layout from '@/Components/Layout.vue';

defineProps({
  orders: Object
});
</script>
