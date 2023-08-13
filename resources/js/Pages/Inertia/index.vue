<script setup>
  import { Link } from '@inertiajs/inertia-vue3';

  defineProps({
    'records': Array
  });
</script>
<template>
  <div v-if="$page.props.flash.message" class="bg-blue-300">
    {{ $page.props.flash.message }}
  </div>

  <ul>
    <li v-for="record in records" :key="record.id">
      <Link v-if="record" :href="route('inertia.show', { 'id': record.id })">
        件名：{{ record.title }} / 本文：{{ record.content }}
      </Link>
    </li>
  </ul>

</template>