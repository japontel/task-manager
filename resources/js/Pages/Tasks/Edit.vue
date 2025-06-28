<template>
  <div class="p-6 max-w-md mx-auto">
    <h1 class="text-xl font-bold mb-4">Edit Task</h1>

    <form @submit.prevent="submit">
      <!-- Title -->
      <div class="mb-4">
        <label class="block mb-1">Title</label>
        <input v-model="form.title" type="text" class="border rounded w-full p-2" />
        <div v-if="form.errors.title" class="text-red-600 text-sm mt-1">
          {{ form.errors.title }}
        </div>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label class="block mb-1">Description</label>
        <textarea v-model="form.description" class="border rounded w-full p-2"></textarea>
      </div>

      <!-- Category -->
      <div class="mb-4">
        <label class="block mb-1">Category</label>
        <select v-model="form.category_id" class="border rounded w-full p-2">
          <option v-for="cat in categories" :key="cat.id" :value="cat.id">
            {{ cat.name }}
          </option>
        </select>
      </div>

      <!-- Status -->
      <div class="mb-4">
        <label class="block mb-1">Status</label>
        <select v-model="form.status" class="border rounded w-full p-2">
          <option v-for="status in statuses" :key="status" :value="status">
            {{ status.replace('_', ' ').toUpperCase() }}
          </option>
        </select>
      </div>

      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Update
      </button>
    </form>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  task: Object,
  categories: Array,
  statuses: Array
})

const form = useForm({
  title: props.task.title,
  description: props.task.description,
  category_id: props.task.category_id,
  status: props.task.status
})

const submit = () => {
  form.put(route('tasks.update', props.task.id))
}
</script>
