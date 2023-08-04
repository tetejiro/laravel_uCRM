<script setup>
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputLabel from '@/Components/InputLabel.vue';
  import TextInput from '@/Components/TextInput.vue';
</script>

<template>
  <GuestLayout>
    <InputLabel value="a"></InputLabel>
    <TextInput modelValue="modelValue"></TextInput>
  </GuestLayout>
</template>