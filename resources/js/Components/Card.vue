<template>
  <div :class="['bg-white rounded-xl border border-slate-200', containerClass]">
    <div v-if="title" :class="['px-6 py-4 border-b border-slate-200', headerClass]">
      <h3 class="text-lg font-semibold text-slate-900">{{ title }}</h3>
    </div>
    <div :class="['p-6', bodyClass]">
      <slot />
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  containerClass: String,
  headerClass: String,
  bodyClass: String
});
</script>
