<template>
  <div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-50 flex items-center justify-center px-4">
    <Card class="w-full max-w-md">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-2">Seller Login</h2>
        <p class="text-slate-600">Access your seller dashboard</p>
      </div>
      
      <form @submit.prevent="submit">
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
          v-model="form.password"
          id="password"
          type="password"
          label="Password"
          placeholder="••••••••"
          required
          :error="form.errors.password"
        />
        
        <div class="flex items-center mb-6">
          <input
            v-model="form.remember"
            type="checkbox"
            id="remember"
            class="w-4 h-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500"
          />
          <label for="remember" class="ml-2 text-sm text-slate-700">Remember me</label>
        </div>
        
        <Button type="submit" variant="success" class="w-full mb-4" :disabled="form.processing">
          {{ form.processing ? 'Logging in...' : 'Login' }}
        </Button>
        
        <p class="text-center text-sm text-slate-600">
          Not a seller yet?
          <Link href="/seller/register" class="text-emerald-600 hover:text-emerald-700 font-medium">Register</Link>
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
  email: '',
  password: '',
  remember: false
});

const submit = () => {
  form.post('/seller/login');
};
</script>
