<script setup>
  import {Inertia} from '@inertiajs/inertia';

  defineProps({
    id : String,
    record: Object
  })

  const deleteAlerm = id => {
    Inertia.delete(`/inertia/${id}`, {
      onBefore: () => confirm('削除するか？')
    })
  }
</script>
<template>
  id: {{id}}
  records: {{ record }}<br>
  <input type="button" value="削除" @click="deleteAlerm(record.id)">
</template>