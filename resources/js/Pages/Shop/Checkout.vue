<template>
  <Layout>
    <div class="bg-slate-50 min-h-screen py-8">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-slate-900 mb-8">Checkout</h1>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
          <div class="lg:col-span-2">
            <Card title="Shipping Information">
              <form @submit.prevent="submit">
                <div class="grid grid-cols-2 gap-4">
                  <div class="col-span-2">
                    <Input
                      v-model="form.shipping_name"
                      label="Full Name"
                      required
                      :error="form.errors.shipping_name"
                    />
                  </div>
                  
                  <div class="col-span-2 sm:col-span-1">
                    <Input
                      v-model="form.shipping_email"
                      type="email"
                      label="Email"
                      required
                      :error="form.errors.shipping_email"
                    />
                  </div>
                  
                  <div class="col-span-2 sm:col-span-1">
                    <Input
                      v-model="form.shipping_phone"
                      label="Phone"
                      required
                      :error="form.errors.shipping_phone"
                    />
                  </div>
                  
                  <div class="col-span-2">
                    <Input
                      v-model="form.shipping_address"
                      type="textarea"
                      label="Address"
                      :rows="2"
                      required
                      :error="form.errors.shipping_address"
                    />
                  </div>
                  
                  <div class="col-span-2 sm:col-span-1">
                    <Input
                      v-model="form.shipping_city"
                      label="City"
                      required
                      :error="form.errors.shipping_city"
                    />
                  </div>
                  
                  <div class="col-span-2 sm:col-span-1">
                    <Input
                      v-model="form.shipping_state"
                      label="State"
                      required
                      :error="form.errors.shipping_state"
                    />
                  </div>
                  
                  <div class="col-span-2 sm:col-span-1">
                    <Input
                      v-model="form.shipping_zip"
                      label="ZIP Code"
                      required
                      :error="form.errors.shipping_zip"
                    />
                  </div>
                </div>
                
                <Button
                  type="submit"
                  variant="primary"
                  class="w-full mt-6"
                  :disabled="form.processing"
                >
                  {{ form.processing ? 'Processing...' : 'Place Order' }}
                </Button>
              </form>
            </Card>
          </div>
          
          <div>
            <Card title="Order Summary">
              <div class="space-y-3">
                <div
                  v-for="item in cart.items"
                  :key="item.id"
                  class="flex justify-between text-sm"
                >
                  <span class="text-slate-600">{{ item.product.name }} x{{ item.quantity }}</span>
                  <span class="font-medium">${{ (item.product.price * item.quantity).toFixed(2) }}</span>
                </div>
                
                <div class="border-t border-slate-200 pt-3 mt-3">
                  <div class="flex justify-between text-lg font-bold">
                    <span>Total</span>
                    <span class="text-indigo-600">${{ total.toFixed(2) }}</span>
                  </div>
                </div>
              </div>
            </Card>
          </div>
        </div>
      </div>
    </div>
  </Layout>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
import Layout from '@/Components/Layout.vue';
import Card from '@/Components/Card.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';

const props = defineProps({
  cart: Object,
  total: Number
});

const form = useForm({
  shipping_name: '',
  shipping_email: '',
  shipping_phone: '',
  shipping_address: '',
  shipping_city: '',
  shipping_state: '',
  shipping_zip: ''
});

const submit = () => {
  form.post('/shop/checkout');
};
</script>
