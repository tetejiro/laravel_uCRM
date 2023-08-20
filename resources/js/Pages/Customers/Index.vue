<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'
import TextInput from '@/Components/TextInput.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    customers: Array
})

let textVal;

const inputData = val => {
  textVal = val
}

const searchCustomers = () => {
  Inertia.get(route('customers.index', { param: textVal }));
}

</script>

<template>
    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">顧客一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <FlashMessage></FlashMessage>
                        <section class="text-gray-600 body-font">
                          <div class="flex pl-4 mt-4 lg:w-2/3 w-full mx-auto">
                            検索(カナ or tel)
                            <TextInput @update:modelValue="inputData"></TextInput>
                            <Button @click="searchCustomers" class="border-solid border-2 border-green-300 p-2 hover:bg-green-200 rounded">search</Button>
                            <Link as="button" :href="route('customers.create')" class="mr-3 flex ml-auto text-white bg-green-300 border-0 py-2 px-6 focus:outline-none hover:bg-green-200 rounded">
                                顧客登録
                            </Link>
                          </div>
                          <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-2/3 w-full mx-auto overflow-auto">
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
                                    <tr v-for="customer in customers.data" :key="customers.data.id">
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.id }}</td>
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.name }}</td>
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.kana }}</td>
                                        <td class="border-b-2 border-gray-200 px-4 py-3">{{ customer.tel }}</td>
                                    </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          <Pagination :links="customers.links"></Pagination>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
