<script setup>
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';

  const emitTest = val => console.log(val);
</script>

<template>
  <GuestLayout>
    <InputLabel value="a"></InputLabel>
    <TextInput modelValue="modelValue" @update:modelValue="emitTest"></TextInput>
  </GuestLayout>
</template>