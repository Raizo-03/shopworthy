<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center px-4">
    <Card class="w-full max-w-md">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
        <p class="text-slate-600">Login to your account</p>
      </div>
      
      <form @submit.prevent="submit">
        <Input
          v-model="form.email"
          id="email"
          type="email"
          label="Email"
          placeholder="your@email.com"
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
            class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500"
          />
          <label for="remember" class="ml-2 text-sm text-slate-700">Remember me</label>
        </div>
        
        <Button type="submit" variant="primary" class="w-full mb-4" :disabled="form.processing">
          {{ form.processing ? 'Logging in...' : 'Login' }}
        </Button>
        
        <p class="text-center text-sm text-slate-600">
          Don't have an account?
          <Link href="/user/register" class="text-indigo-600 hover:text-indigo-700 font-medium">Sign up</Link>
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
  form.post('/user/login');
};
</script>
