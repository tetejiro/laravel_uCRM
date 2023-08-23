<script setup>
  import axios from 'axios';
  import { ref, reactive } from 'vue';
  import { Link } from '@inertiajs/inertia-vue3';

  let search = ref()

  let isShow = ref(false);
  let customers = reactive({});

  const showToggle = () => isShow.value = !isShow.value;

  let searchCustomers = async () => {
    try {
      await axios.get(`/api/searchCustomers/?search=${search.value}`)
        .then(
            rec => {
              customers.value = rec.data
            }
        )
      showToggle()
    } catch(e) {
      console.log(e)
    }
  }

  const emit = defineEmits(['clickedId'])
  const setId = customer => {
    search.value = customer.kana
    emit('clickedId', customer.id)
    showToggle()
  }
</script>

<template>
  <div v-show="isShow" class="modal" id="modal-1" aria-hidden="true">
    <div class="modal__overlay" tabindex="-1" data-micromodal-close>
      <div class="modal__container w-3/5" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
        <header class="modal__header justify-center">
          <h2 class="modal__title" id="modal-1-title">
            検索結果
          </h2>
          <Link @click="showToggle" type="button" class="pl-20 modal__close" aria-label="Close modal" data-micromodal-close></Link>
        </header>
        <main class="modal__content" id="modal-1-content">
          <div v-if="customers.value" class="w-full mx-auto overflow-auto">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                  <tr>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">id</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">name</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">カナ</th>
                      <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">tel</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="customer in customers.value.data" :key="customers.id">
                      <td class="border-b-2 border-gray-200 px-4 py-3">
                        <div @click="setId(customer)">{{ customer.id }}</div>
                      </td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.name }}</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.kana }}</td>
                      <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.tel }}</td>
                  </tr>
              </tbody>
            </table>
          </div>
        </main>
        <footer class="modal__footer text-center">
          <button @click="showToggle" type="button" class="modal__btn" data-micromodal-close aria-label="Close this dialog window">Close</button>
        </footer>
      </div>
    </div>
  </div>
  <div class="flex w-full">
    <input name="customer" v-model="search" class="w-2/3 bg-white-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
    <button @click="searchCustomers" type="button"
            class="mx-auto text-black border-2 py-1 px-2 focus:outline-none rounded text-lg" data-micromodal-trigger="modal-1">
      検索
    </button>
  </div>
</template>