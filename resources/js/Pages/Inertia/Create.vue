<script setup>
  import {reactive, render} from 'vue';
  import {Inertia} from '@inertiajs/inertia';

  const form = reactive({
    title: null,
    contents: null
  });

  const submitFunction = () => {
    Inertia.post('/inertia/store', form);
  }
</script>
<template>
  <form @submit.prevent="submitFunction">
    <input type="text" v-model="form.title"><br>
    <input type="text" v-model="form.contents"><br>
    <button type="submit">送信</button>
  </form>
</template>