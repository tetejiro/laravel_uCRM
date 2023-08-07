<script setup>
  import { Link } from '@inertiajs/inertia-vue3';
  import { ref } from 'vue';

  const newTitle = ref('');
  const newContent = ref('');
</script>

<template>
  Inertiaテスト<br>
  <a href="/">aタグ</a><br>
  <Link href="/">Linkタグ</Link><br>
  <Link :href="route('inertia.index')">名前付きルート</Link><br>
  <Link :href="route('inertia.show', {id: 1})">ルートパラメータ</Link>

  <div class="mb-8"></div>
  <input type="text" name="newTitle" v-model="newTitle"><br>
  <input type="text" name="newContent" v-model="newContent"><br>
  <Link as="button" :href="route('inertia.store')" method="post"
    :data="{
      title: newTitle,
      content: newContent
    }"
  >保存ボタン</Link>
</template>