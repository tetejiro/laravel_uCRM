<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import { Inertia } from '@inertiajs/inertia';
  import dayjs from 'dayjs'

  const props = defineProps(['subtotal', 'all'])

  const total = props.subtotal.reduce((sum, num) => {
    return sum + num;
  }, 0)

  const editPurchase = () => {
    Inertia.post(route('purchases.edit', {purchase: props.all[0].id}));
  }

</script>

<template>
  <Head title="購入詳細" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入詳細</h2>
    </template>

    <form @submit.prevent="editPurchase">
      <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <section class="text-gray-600 body-font relative">
                <div class="container px-5 py-2.5 mx-auto">
                  <div class="lg:w-2/3 w-full mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="relative">
                          <label for="date" class="leading-7 text-sm text-gray-600">date</label>
                          <div type="date" id="date" name="date" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            {{ dayjs(props.all.date).format('YYYY-MM-DD') }}
                          </div>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <div class="leading-7 text-sm text-gray-600">customer</div>
                          <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            {{ props.all[0].customer_name }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <section class="text-gray-600 body-font">
                  <div class="container px-5 py-2.5 mx-auto">
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                      <div class="leading-7 p-2 text-sm text-gray-600">詳細</div>
                      <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                          <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                              商品番号
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              商品名
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              値段
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                              数量
                            </th>
                            <th class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                              小計
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="detail in props.all" :key="detail.item_id">
                            <td class="px-4 py-3">{{ detail.item_id }}</td>
                            <td class="px-4 py-3">{{ detail.item_name }}</td>
                            <td class="px-4 py-3">{{ detail.item_price }}</td>
                            <td class="px-4 py-3">{{ detail.quantity }}</td>
                            <td class="w-10 text-center">{{ detail.subtotal }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="leading-7 pt-5 text-sm text-gray-600">合計金額</div>
                      <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        {{ total }}
                      </div>
                      <div v-if="props.all[0].status == 0" class="leading-7 pt-4 text-sm text-gray-600">ステータス</div>
                      <div v-if="props.all[0].status == 0" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        キャンセル済
                      </div>
                      <div v-if="props.all[0].status == 0">
                        <div class="leading-7 pt-4 text-sm text-gray-600">キャンセル日</div>
                        <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                          {{ dayjs(props.all[0].updated_at).format('YYYY-MM-DD') }}
                        </div>
                      </div>
                    </div>
                  </div>
                </section>

                <div class="p-2 w-full">
                  <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    編集
                  </button>
                </div>

              </section>
            </div>
          </div>
        </div>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
