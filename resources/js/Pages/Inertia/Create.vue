<script setup>
  import {reactive, render} from 'vue';
  import {Inertia} from '@inertiajs/inertia';

  const form = reactive({
    title: null,
    content: null
  });

  defineProps({
    errors: Object
  })

  const submitFunction = () => {
    Inertia.post('/inertia/store', form);
  }
</script>
<template>
  <div>Create.vue</div>
  <form @submit.prevent="submitFunction">
    <input type="text" v-model="form.title"><br>
    <div v-if="errors.title">{{ errors.title }}</div>
    <input type="text" v-model="form.content"><br>
    <div v-if="errors.content">{{ errors.content }}</div>
    <button type="submit">送信</button>
  </form>
</template>