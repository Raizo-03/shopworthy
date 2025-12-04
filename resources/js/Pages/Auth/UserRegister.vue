<template>
  <div class="min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 flex items-center justify-center px-4">
    <Card class="w-full max-w-md">
      <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
        <p class="text-slate-600">Start shopping today</p>
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
        
        <Input
          v-model="form.password_confirmation"
          id="password_confirmation"
          type="password"
          label="Confirm Password"
          placeholder="••••••••"
          required
        />
        
        <Button type="submit" variant="primary" class="w-full mb-4" :disabled="form.processing">
          {{ form.processing ? 'Creating Account...' : 'Sign Up' }}
        </Button>
        
        <p class="text-center text-sm text-slate-600">
          Already have an account?
          <Link href="/user/login" class="text-indigo-600 hover:text-indigo-700 font-medium">Login</Link>
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
  password: '',
  password_confirmation: ''
});

const submit = () => {
  form.post('/user/register');
};
</script>
