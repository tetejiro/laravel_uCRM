<!-- <script setup>
  import { computed } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';

  const props = defineProps([
    'href', 'active'
  ]);

  const classes = computed(() => {
    props.active
      ? 'border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
      : 'border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
  })
</script>

<template>
  <Link :href="href" :class="classes">
    <slot></slot>
  </Link>
</template> -->

<script setup>
  import { Link } from '@inertiajs/inertia-vue3';
  defineProps({ links: Array })
</script>

<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap justify-center -mb-1">
      <template v-for="link in links" :key="index">

        <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded" v-html="link.label">
        </div>

        <Link v-else :href="link.url" v-html="link.label" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-blue-700 text-white': link.active }">
        </Link>

      </template>
    </div>
  </div>
</template>