<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ category: Object })

const form = useForm({
  name: props.category.name
})

const submit = () => {
  form.put(route('categories.update', props.category.id))
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
