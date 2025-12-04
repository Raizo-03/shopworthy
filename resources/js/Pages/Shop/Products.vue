<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
          <h1 class="text-3xl font-bold text-slate-900 mb-4">Shop Products</h1>
          
          <div class="flex flex-col md:flex-row gap-4">
            <input
              v-model="searchQuery"
              @input="search"
              type="text"
              placeholder="Search products..."
              class="flex-1 px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
            />
            
            <select
              v-model="selectedCategory"
              @change="filterByCategory"
              class="px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
            >
              <option value="">All Categories</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>
        </div>
        
        <div v-if="products.data.length === 0" class="text-center py-12">
          <p class="text-slate-600 text-lg">No products found</p>
        </div>
        
        <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <div
            v-for="product in products.data"
            :key="product.id"
            class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-200"
          >
            <Link :href="`/shop/product/${product.slug}`">
              <div class="aspect-square bg-slate-100 flex items-center justify-center">
                <img
                  v-if="product.image"
                  :src="`/storage/${product.image}`"
                  :alt="product.name"
                  class="w-full h-full object-cover"
                />
                <svg v-else class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              
              <div class="p-4">
                <h3 class="font-semibold text-slate-900 mb-1 line-clamp-1">{{ product.name }}</h3>
                <p class="text-sm text-slate-600 mb-2 line-clamp-2">{{ product.description }}</p>
                <div class="flex items-center justify-between">
                  <span class="text-xl font-bold text-indigo-600">${{ product.price }}</span>
                  <span class="text-sm text-slate-500">Stock: {{ product.stock }}</span>
                </div>
              </div>
            </Link>
          </div>
        </div>
        
        <div v-if="products.links.length > 3" class="mt-8 flex justify-center space-x-2">
          <Link
            v-for="(link, index) in products.links"
            :key="index"
            :href="link.url"
            :class="[
              'px-4 py-2 rounded-lg border',
              link.active
                ? 'bg-indigo-600 text-white border-indigo-600'
                : 'bg-white text-slate-700 border-slate-300 hover:bg-slate-50'
            ]"
            v-html="link.label"
          />
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';

const props = defineProps({
  products: Object,
  categories: Array,
  filters: Object
});

const searchQuery = ref(props.filters.search || '');
const selectedCategory = ref(props.filters.category || '');

const search = () => {
  router.get('/shop', {
    search: searchQuery.value,
    category: selectedCategory.value
  }, {
    preserveState: true,
    preserveScroll: true
  });
};

const filterByCategory = () => {
  router.get('/shop', {
    search: searchQuery.value,
    category: selectedCategory.value
  }, {
    preserveState: true,
    preserveScroll: true
  });
};
</script>
