<script setup>
import { defineProps } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  categories: Array
})

const deleteCategory = (id) => {
  if (confirm('Are you sure?')) {
    router.delete(route('categories.destroy', id))
  }
}
</script>

<template>
  <div class="p-6">
    <a href="/categories/create" class="bg-green-600 text-white px-3 py-2 rounded">+ New Category</a>

    <h1 class="text-xl font-bold mt-4">Categories</h1>

    <table class="w-full mt-4 border">
      <thead>
        <tr class="bg-gray-100">
          <th class="border p-2">Name</th>
          <th class="border p-2">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories" :key="category.id">
          <td class="border p-2">{{ category.name }}</td>
          <td class="border p-2">
            <a :href="`/categories/${category.id}/edit`" class="text-blue-600 mr-2">Edit</a>
            <button @click="deleteCategory(category.id)" class="text-red-600">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
