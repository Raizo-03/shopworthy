<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div class="aspect-square bg-slate-100 rounded-lg flex items-center justify-center">
              <img
                v-if="product.image"
                :src="`/storage/${product.image}`"
                :alt="product.name"
                class="w-full h-full object-cover rounded-lg"
              />
              <svg v-else class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            
            <div>
              <h1 class="text-3xl font-bold text-slate-900 mb-4">{{ product.name }}</h1>
              <div class="mb-4">
                <span class="text-3xl font-bold text-indigo-600">${{ product.price }}</span>
              </div>
              
              <div class="mb-6">
                <span class="inline-block px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm font-medium">
                  {{ product.category.name }}
                </span>
              </div>
              
              <p class="text-slate-700 mb-6">{{ product.description }}</p>
              
              <div class="mb-6">
                <p class="text-sm text-slate-600 mb-2">Seller: <span class="font-medium">{{ product.seller.shop_name }}</span></p>
                <p class="text-sm text-slate-600">Available Stock: <span class="font-medium">{{ product.stock }}</span></p>
              </div>
              
              <div class="flex items-center space-x-4 mb-6">
                <label class="text-sm font-medium text-slate-700">Quantity:</label>
                <input
                  v-model.number="quantity"
                  type="number"
                  min="1"
                  :max="product.stock"
                  class="w-20 px-3 py-2 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
                />
              </div>
              
              <Button
                @click="addToCart"
                variant="primary"
                class="w-full"
                :disabled="form.processing || product.stock < 1"
              >
                {{ product.stock < 1 ? 'Out of Stock' : 'Add to Cart' }}
              </Button>
            </div>
          </div>
        </div>
        
        <div v-if="relatedProducts.length > 0" class="mt-12">
          <h2 class="text-2xl font-bold text-slate-900 mb-6">Related Products</h2>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div
              v-for="relProduct in relatedProducts"
              :key="relProduct.id"
              class="bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-lg transition-shadow duration-200"
            >
              <Link :href="`/shop/product/${relProduct.slug}`">
                <div class="aspect-square bg-slate-100 flex items-center justify-center">
                  <img
                    v-if="relProduct.image"
                    :src="`/storage/${relProduct.image}`"
                    :alt="relProduct.name"
                    class="w-full h-full object-cover"
                  />
                  <svg v-else class="w-12 h-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
                <div class="p-4">
                  <h3 class="font-semibold text-slate-900 mb-1 line-clamp-1">{{ relProduct.name }}</h3>
                  <span class="text-lg font-bold text-indigo-600">${{ relProduct.price }}</span>
                </div>
              </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, useForm } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Button from '@/Components/Button.vue';

const props = defineProps({
  product: Object,
  relatedProducts: Array
});

const quantity = ref(1);

const form = useForm({
  product_id: props.product.id,
  quantity: 1
});

const addToCart = () => {
  form.quantity = quantity.value;
  form.post('/shop/cart/add', {
    preserveScroll: true,
    onSuccess: () => {
      quantity.value = 1;
    }
  });
};
</script>
