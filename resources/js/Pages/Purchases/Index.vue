<script setup>
  import Pagination from '@/Components/Pagination.vue'
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import FlashMessage from '@/Components/FlashMessage.vue'
  import dayjs from 'dayjs'
  import { Head, Link } from '@inertiajs/inertia-vue3';

  defineProps(['orders'])
</script>

<template>
  <Head title="購入履歴" />

  <AuthenticatedLayout>
      <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入履歴</h2>
      </template>

      <div class="py-12">
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
              <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                  <div class="p-6 text-gray-900">
                      <FlashMessage></FlashMessage>
                      <section class="text-gray-600 body-font">
                        <div class="container px-5 py-8 mx-auto">
                          <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                              <thead>
                                  <tr>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">amount</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">status</th>
                                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">購入日</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr v-for="order in orders.data" :key="order.id">
                                      <td class="border-b-2 border-gray-200 px-4 py-3">
                                        <Link class="text-green-700" :href="route('purchases.show', {purchase: order})">
                                          {{ order.id }}
                                        </Link>
                                      </td>
                                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ order.customer_name }}</td>
                                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ order.total }}</td>
                                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ order.status }}</td>
                                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ dayjs(order.created_at).format('YYYY-MM-DD') }}</td>
                                  </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <Pagination :links="orders.links"></Pagination>
                      </section>
                  </div>
              </div>
          </div>
      </div>
  </AuthenticatedLayout>

</template>
