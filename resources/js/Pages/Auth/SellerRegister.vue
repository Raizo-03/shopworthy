<template>
  <div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center px-4 py-8">
    <Card class="w-full max-w-md">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-2">Become a Seller</h2>
        <p class="text-slate-600">Start selling your products today</p>
      </div>
      
      <form @submit.prevent="submit">
        <Input
          v-model="form.name"
          id="name"
          label="Full Name"
          placeholder="John Doe"
          required
          :error="form.errors.name"
        />
        
        <Input
          v-model="form.email"
          id="email"
          type="email"
          label="Email"
          placeholder="seller@email.com"
          required
          :error="form.errors.email"
        />
        
        <Input
          v-model="form.shop_name"
          id="shop_name"
          label="Shop Name"
          placeholder="My Amazing Shop"
          required
          :error="form.errors.shop_name"
        />
        
        <Input
          v-model="form.shop_description"
          id="shop_description"
          type="textarea"
          label="Shop Description"
          placeholder="Tell us about your shop..."
          :rows="3"
          :error="form.errors.shop_description"
        />
        
        <Input
          v-model="form.phone"
          id="phone"
          label="Phone Number"
          placeholder="+1234567890"
          :error="form.errors.phone"
        />
        
        <Input
          v-model="form.password"
          id="password"
          type="password"
          label="Password"
          placeholder="••••••••"
          required
          :error="form.errors.password"
        />
        
        <Input
          v-model="form.password_confirmation"
          id="password_confirmation"
          type="password"
          label="Confirm Password"
          placeholder="••••••••"
          required
        />
        
        <Button type="submit" variant="success" class="w-full mb-4" :disabled="form.processing">
          {{ form.processing ? 'Creating Account...' : 'Register as Seller' }}
        </Button>
        
        <p class="text-center text-sm text-slate-600">
          Already a seller?
          <Link href="/seller/login" class="text-emerald-600 hover:text-emerald-700 font-medium">Login</Link>
        </p>
      </form>
    </Card>
  </div>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import Input from '@/Components/Input.vue';
import Button from '@/Components/Button.vue';

const form = useForm({
  name: '',
  email: '',
  shop_name: '',
  shop_description: '',
  phone: '',
  password: '',
  password_confirmation: ''
});

const submit = () => {
  form.post('/seller/register');
};
</script>
