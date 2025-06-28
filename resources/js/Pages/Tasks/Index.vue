<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  tasks: Array
})
</script>

<template>
  <div class="p-6">
    <router-link href="/tasks/create" class="bg-green-600 text-white px-3 py-2 rounded mb-5">
      + New Task
    </router-link>
  
    <h1 class="text-2xl font-bold mb-4">Your Tasks</h1>

    <div v-if="tasks.length">
      <table class="w-full text-left border">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-2 border">Title</th>
            <th class="p-2 border">Category</th>
            <th class="p-2 border">Created At</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td class="p-2 border">{{ task.title }}</td>
            <td class="p-2 border">{{ task.category?.name || 'Uncategorized' }}</td>
            <td class="p-2 border">{{ new Date(task.created_at).toLocaleDateString() }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-gray-500 mt-4">
      No tasks found.
    </div>
  </div>
</template>
