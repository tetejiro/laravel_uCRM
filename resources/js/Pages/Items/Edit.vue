<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import { Inertia } from '@inertiajs/inertia';
  import { Head } from '@inertiajs/inertia-vue3';
  import { reactive } from 'vue';

  const props = defineProps({
    errors: Object,
    Item: Array
  });

  const form = reactive({
    id: props.Item.id,
    name: props.Item.name,
    memo: props.Item.memo,
    price: props.Item.price,
    is_selling: props.Item.is_selling
  });

  const updateItem = id => {
    Inertia.put(route('Items.update', { Item: id }), form);
  }
</script>

<template>
  <Head title="商品登録" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品登録</h2>
    </template>

    <form @submit.prevent="updateItem(id)">
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
              <section class="text-gray-600 body-font relative">
                <div class="container px-5 py-19 mx-auto">
                  <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    <div class="flex flex-wrap -m-2">
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.name"></InputError>
                          <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                          <input type="text" id="name" name="name" v-model="form.name"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.memo"></InputError>
                          <label for="memo" class="leading-7 text-sm text-gray-600">memo</label>
                          <textarea id="memo" name="memo" v-model="form.memo" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.price"></InputError>
                          <label for="price" class="leading-7 text-sm text-gray-600">price</label>
                          <input type="number" id="price" name="price" v-model="form.price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.is_selling"></InputError>
                          <label class="leading-7 text-sm text-gray-600">
                          <input type="radio" name="is_selling" value="0" v-model="form.is_selling"> 販売中  </label>
                          <label class="leading-7 text-sm text-gray-600">
                          <input type="radio" name="is_selling" value="1" v-model="form.is_selling"> 販売中止</label>
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
        </div>
      </div>
    </form>
  </AuthenticatedLayout>
</template>
