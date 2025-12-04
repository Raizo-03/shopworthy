<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
          <h1 class="text-3xl font-bold text-slate-900">My Products</h1>
          <Link href="/seller/products/create">
            <Button variant="primary">Add New Product</Button>
          </Link>
        </div>
        
        <div v-if="products.data.length === 0" class="bg-white rounded-xl border border-slate-200 p-12 text-center">
          <p class="text-slate-600 text-lg mb-4">No products yet</p>
          <Link href="/seller/products/create">
            <Button variant="primary">Add Your First Product</Button>
          </Link>
        </div>
        
        <div v-else class="bg-white rounded-xl border border-slate-200 overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Product</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Category</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Price</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Stock</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-slate-700 uppercase">Status</th>
                  <th class="px-6 py-3 text-right text-xs font-medium text-slate-700 uppercase">Actions</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-slate-200">
                <tr v-for="product in products.data" :key="product.id">
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="w-12 h-12 bg-slate-100 rounded flex-shrink-0">
                        <img
                          v-if="product.image"
                          :src="`/storage/${product.image}`"
                          :alt="product.name"
                          class="w-full h-full object-cover rounded"
                        />
                      </div>
                      <div class="ml-3">
                        <p class="font-medium text-slate-900">{{ product.name }}</p>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-slate-600">{{ product.category.name }}</td>
                  <td class="px-6 py-4 font-medium text-slate-900">${{ product.price }}</td>
                  <td class="px-6 py-4 text-slate-600">{{ product.stock }}</td>
                  <td class="px-6 py-4">
                    <span
                      :class="[
                        'inline-block px-2 py-1 rounded-full text-xs font-medium',
                        product.is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700'
                      ]"
                    >
                      {{ product.is_active ? 'Active' : 'Inactive' }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-right space-x-2">
                    <Link :href="`/seller/products/${product.id}/edit`">
                      <button class="text-indigo-600 hover:text-indigo-800">Edit</button>
                    </Link>
                    <button
                      @click="deleteProduct(product.id)"
                      class="text-red-600 hover:text-red-800"
                    >
                      Delete
                    </button>
                  </td>
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
import { Link, router } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Button from '@/Components/Button.vue';

defineProps({
  products: Object
});

const deleteProduct = (id) => {
  if (confirm('Are you sure you want to delete this product?')) {
    router.delete(`/seller/products/${id}`);
  }
};
</script>
