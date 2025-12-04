<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Add New Product</h1>
        
        <Card>
          <form @submit.prevent="submit">
            <Input
              v-model="form.name"
              label="Product Name"
              required
              :error="form.errors.name"
            />
            
            <div class="mb-4">
              <label class="block text-sm font-medium text-slate-700 mb-2">
                Category <span class="text-red-500">*</span>
              </label>
              <select
                v-model="form.category_id"
                required
                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
              >
                <option value="">Select a category</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">
                  {{ category.name }}
                </option>
              </select>
              <p v-if="form.errors.category_id" class="mt-1 text-sm text-red-600">{{ form.errors.category_id }}</p>
            </div>
            
            <Input
              v-model="form.description"
              type="textarea"
              label="Description"
              :rows="4"
              required
              :error="form.errors.description"
            />
            
            <div class="grid grid-cols-2 gap-4">
              <Input
                v-model="form.price"
                type="number"
                step="0.01"
                label="Price"
                required
                :error="form.errors.price"
              />
              
              <Input
                v-model="form.stock"
                type="number"
                label="Stock"
                required
                :error="form.errors.stock"
              />
            </div>
            
            <div class="mb-4">
              <label class="block text-sm font-medium text-slate-700 mb-2">Product Image</label>
              <input
                @change="handleFileChange"
                type="file"
                accept="image/*"
                class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"
              />
              <p v-if="form.errors.image" class="mt-1 text-sm text-red-600">{{ form.errors.image }}</p>
            </div>
            
            <div class="flex items-center mb-6">
              <input
                v-model="form.is_active"
                type="checkbox"
                id="is_active"
                class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
              />
              <label for="is_active" class="ml-2 text-sm text-slate-700">Active (visible to customers)</label>
            </div>
            
            <div class="flex space-x-4">
              <Button type="submit" variant="primary" :disabled="form.processing">
                {{ form.processing ? 'Creating...' : 'Create Product' }}
              </Button>
              <Link href="/seller/products">
                <Button variant="secondary">Cancel</Button>
              </Link>
            </div>
          </form>
        </Card>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Card from '@/Components/Card.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';

defineProps({
  categories: Array
});

const form = useForm({
  name: '',
  category_id: '',
  description: '',
  price: '',
  stock: '',
  image: null,
  is_active: true
});

const handleFileChange = (e) => {
  form.image = e.target.files[0];
};

const submit = () => {
  form.post('/seller/products');
};
</script>
