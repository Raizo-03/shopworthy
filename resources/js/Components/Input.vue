<template>
  <div class="mb-4">
    <label v-if="label" :for="id" class="block text-sm font-medium text-slate-700 mb-2">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    
    <input
      v-if="type !== 'textarea'"
      :id="id"
      :type="type"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      :required="required"
      :disabled="disabled"
      :class="[
        'w-full px-4 py-3 rounded-lg border transition-all duration-200',
        error 
          ? 'border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-200' 
          : 'border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200',
        disabled ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'
      ]"
    />
    
    <textarea
      v-else
      :id="id"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      :placeholder="placeholder"
      :required="required"
      :disabled="disabled"
      :rows="rows"
      :class="[
        'w-full px-4 py-3 rounded-lg border transition-all duration-200',
        error 
          ? 'border-red-300 focus:border-red-500 focus:ring-2 focus:ring-red-200' 
          : 'border-slate-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200',
        disabled ? 'bg-slate-100 cursor-not-allowed' : 'bg-white'
      ]"
    ></textarea>
    
    <p v-if="error" class="mt-1 text-sm text-red-600">{{ error }}</p>
    <p v-else-if="hint" class="mt-1 text-sm text-slate-500">{{ hint }}</p>
  </div>
</template>

<script setup>
defineProps({
  id: String,
  label: String,
  type: {
    type: String,
    default: 'text'
  },
  modelValue: [String, Number],
  placeholder: String,
  required: Boolean,
  disabled: Boolean,
  error: String,
  hint: String,
  rows: {
    type: Number,
    default: 4
  }
});

defineEmits(['update:modelValue']);
</script>
