<script setup>
  import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
  Inertiaテスト<br>
  <a href="/">aタグ</a><br>
  <Link href="/">Linkタグ</Link><br>
  <Link :href="route('inertia.index')">名前付きルート</Link><br>
  <Link :href="route('inertia.show', {id: 1})">ルートパラメータ</Link>
</template>