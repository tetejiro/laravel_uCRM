<script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import { Inertia } from '@inertiajs/inertia';
  import { Head } from '@inertiajs/inertia-vue3';
  import { reactive } from 'vue';
  import { Core as YubinBangoCore } from 'yubinbango-core2';

  defineProps({
    errors: Object
  });

  const form = reactive({
    name: null,
    kana: null,
    tel: null,
    email: null,
    postcode: null,
    address: null,
    birthday: null,
    gender: null,
    memo: null
  });

  const storeCustomer = () => {
    Inertia.post('/customers', form);
  }

  const fetchAddress = () => {
    new YubinBangoCore(String(form.postcode), (value) => {
      form.address = value.region; // 都道府県
      form.address += value.locality; // 市区町村
      form.address += value.street; // 町域
    })
  }
</script>

<template>
  <Head title="顧客登録" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客登録</h2>
    </template>

    <form @submit.prevent="storeCustomer">
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
                          <InputError :message="errors.kana"></InputError>
                          <label for="kana" class="leading-7 text-sm text-gray-600">kana</label>
                          <input type="text" id="kana" name="kana" v-model="form.kana"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.tel"></InputError>
                          <label for="tel" class="leading-7 text-sm text-gray-600">tel</label>
                          <input type="tel" id="tel" name="tel" v-model="form.tel"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.email"></InputError>
                          <label for="email" class="leading-7 text-sm text-gray-600">email</label>
                          <input type="email" id="email" name="email" v-model="form.email"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.postcode"></InputError>
                          <label for="postcode" class="leading-7 text-sm text-gray-600">postcode</label>
                          <input type="number" id="postcode" name="postcode" v-model="form.postcode" @change="fetchAddress"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.address"></InputError>
                          <label for="address" class="leading-7 text-sm text-gray-600">address</label>
                          <input type="text" id="address" name="address" v-model="form.address"
                                  class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                      </div>
                      <div class="p-2 w-full">
                        <div class="relative">
                          <InputError :message="errors.birthday"></InputError>
                          <label for="birthday" class="leading-7 text-sm text-gray-600">birthday</label>
                          <input type="date" id="birthday" name="birthday" v-model="form.birthday"
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
                        <div class="relative py-5">
                          <InputError :message="errors.gender"></InputError>
                          <label>男<input type="radio" name="gender" v-model="form.gender" value="0" class="mx-1"></label>
                          <label class="px-3">女<input type="radio" name="gender" v-model="form.gender" value="1" class="mx-1"></label>
                          <label>その他<input type="radio" name="gender" v-model="form.gender" value="2" class="mx-1"></label>
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
