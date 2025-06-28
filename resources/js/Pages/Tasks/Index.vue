<script setup>
import { defineProps } from 'vue'
import { router, Link } from '@inertiajs/vue3'

const props = defineProps({
  tasks: Array
})

const deleteTask = (id) => {
  if (confirm('Are you sure you want to delete this task?')) {
    router.delete(route('tasks.destroy', id))
  }
}
</script>

<template>
  <div class="p-6">
    <Link href="/tasks/create" class="bg-green-600 text-white px-3 py-2 rounded mb-5 inline-block">
    + New Task
    </Link>

    <h1 class="text-2xl font-bold mb-4">Your Tasks</h1>

    <div v-if="tasks.length">
      <table class="w-full text-left border">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-2 border">Title</th>
            <th class="p-2 border">Category</th>
            <th class="p-2 border">Created At</th>
            <th class="p-2 border">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="task in tasks" :key="task.id">
            <td class="p-2 border">{{ task.title }}</td>
            <td class="p-2 border">{{ task.category?.name || 'Uncategorized' }}</td>
            <td class="p-2 border">{{ new Date(task.created_at).toLocaleDateString() }}</td>
            <td class="p-2 border">
              <Link :href="route('tasks.edit', task.id)" class="text-blue-600 hover:underline">
                Edit
              </Link>
              <button @click="deleteTask(task.id)" class="text-red-600 hover:underline ml-2">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-gray-500 mt-4">
      No tasks found.
    </div>
  </div>
</template>
