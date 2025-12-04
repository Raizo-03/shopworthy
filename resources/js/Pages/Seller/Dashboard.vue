<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Seller Dashboard</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
          <Card>
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-slate-600 mb-1">Total Products</p>
                <p class="text-3xl font-bold text-slate-900">{{ stats.totalProducts }}</p>
              </div>
              <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
              </div>
            </div>
          </Card>
          
          <Card>
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-slate-600 mb-1">Active Products</p>
                <p class="text-3xl font-bold text-emerald-600">{{ stats.activeProducts }}</p>
              </div>
              <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
          </Card>
          
          <Card>
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-slate-600 mb-1">Total Orders</p>
                <p class="text-3xl font-bold text-purple-600">{{ stats.totalOrders }}</p>
              </div>
              <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
              </div>
            </div>
          </Card>
          
          <Card>
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-slate-600 mb-1">Total Revenue</p>
                <p class="text-3xl font-bold text-indigo-600">${{ stats.totalRevenue.toFixed(2) }}</p>
              </div>
              <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
          </Card>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
          <Card title="Recent Orders">
            <div v-if="recentOrders.length === 0" class="text-center py-8 text-slate-600">
              No recent orders
            </div>
            <div v-else class="space-y-4">
              <div
                v-for="order in recentOrders"
                :key="order.id"
                class="flex items-center justify-between pb-4 border-b border-slate-200 last:border-0"
              >
                <div>
                  <p class="font-medium text-slate-900">{{ order.product.name }}</p>
                  <p class="text-sm text-slate-600">Qty: {{ order.quantity }} • ${{ (order.price * order.quantity).toFixed(2) }}</p>
                </div>
                <div class="text-right">
                  <p class="text-sm text-slate-600">{{ new Date(order.created_at).toLocaleDateString() }}</p>
                </div>
              </div>
            </div>
          </Card>
          
          <Card title="Top Products">
            <div v-if="topProducts.length === 0" class="text-center py-8 text-slate-600">
              No sales data yet
            </div>
            <div v-else class="space-y-4">
              <div
                v-for="item in topProducts"
                :key="item.product_id"
                class="flex items-center justify-between pb-4 border-b border-slate-200 last:border-0"
              >
                <div>
                  <p class="font-medium text-slate-900">{{ item.product.name }}</p>
                  <p class="text-sm text-slate-600">Sold: {{ item.total_sold }} units</p>
                </div>
                <div class="text-right">
                  <p class="font-bold text-indigo-600">${{ item.revenue }}</p>
                </div>
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
  stats: Object,
  recentOrders: Array,
  monthlySales: Array,
  topProducts: Array
});
</script>
