<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: ''
})

const submit = () => {
  form.post(route('categories.store'))
}
</script>

<template>
  <div class="p-6">
    <h1 class="text-xl font-bold mb-4">Create Category</h1>

    <form @submit.prevent="submit">
      <label class="block mb-2">Name</label>
      <input v-model="form.name" type="text" class="border rounded p-2 w-full mb-4" />
      <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
  </div>
</template>
