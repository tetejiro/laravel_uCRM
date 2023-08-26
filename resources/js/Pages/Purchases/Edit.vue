<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import InputError from '@/Components/InputError.vue'
  import dayjs from 'dayjs'
  import { Inertia } from '@inertiajs/inertia'
  import { computed, onMounted, reactive } from 'vue';

  const props = defineProps(['items', 'order', 'errors'])
  const quantities = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

  let form = reactive({
    id: props.order[0].id,
    date: dayjs(props.order[0].date).format('YYYY-MM-DD'),
    customer_id: props.order[0].customer_id,
    status: props.order[0].status,
    items: []
  })

  const itemList = reactive([])

  props.items.forEach(item => {
    itemList.push({
      id: item.id,
      name: item.name,
      price: item.price,
      status : item.status,
      quantity: item.quantity
    })
  });

  const totalPrice = computed(() => {
    let num = 0;
    itemList.forEach(item => {
      num = num + item.price * item.quantity
    })
    return num
  })

  const updatePurchase = () => {
    Inertia.put(route('purchases.update', {purchase: form.id}), form)
  }

  onMounted(() => {
    console.log(form.id)
  })

</script>

<template>
  <Head title="購入画面" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入画面</h2>
    </template>

    <form @submit.prevent="updatePurchase">
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <section class="text-gray-600 body-font relative">

                <div class="container px-5 py-2.5 mx-auto">
                  <div class="lg:w-2/3 w-full mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.date"></InputError>
                          <label for="date" class="leading-7 text-sm text-gray-600">date</label>
                          <input disabled type="date" id="date" name="date" :value="form.date"
                            class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.date"></InputError>
                          <label class="leading-7 text-sm text-gray-600">name</label>
                          <input disabled type="text" name="name" :value="props.order[0].customer_name"
                            class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <section class="text-gray-600 body-font">
                  <div class="container px-5 py-2.5 mx-auto">
                    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                      <div class="leading-7 text-sm text-gray-600">Price</div>
                      <table class="table-auto w-full text-left whitespace-no-wrap">
                        <thead>
                          <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">
                              id
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
                          <tr v-for="item in itemList" :key="item.id">
                            <td class="px-4 py-3">{{ item.id }}</td>
                            <td class="px-4 py-3">{{ item.name }}</td>
                            <td class="px-4 py-3">{{ item.price }}</td>
                            <td class="px-4 py-3">
                              <select name="quantity" v-model="item.quantity">
                                <option v-for="num in quantities" :key="num" :value="num">
                                  {{ num }}
                                </option>
                              </select>
                            </td>
                            <td class="w-10 text-center">{{ item.price * item.quantity }}</td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="leading-7 text-sm text-gray-600">合計金額</div>
                      <div class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        {{ totalPrice }}
                      </div>
                      <div v-show="props.order[0].status == 1">
                        <div class="pt-4 leading-7 text-sm text-gray-600">status</div>
                        <label>ノーキャンセル<input type="radio" name="status" v-model="form.status" value="1" class="mx-2"></label>
                        <label>キャンセル<input type="radio" name="status" v-model="form.status" value="0" class="mx-2"></label>
                      </div>
                    </div>
                  </div>
                </section>

                <div class="p-2 w-full">
                  <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                    登録
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
