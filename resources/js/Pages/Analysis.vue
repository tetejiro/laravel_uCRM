<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Chart from '@/Components/Chart.vue';
    import ResultTable from '@/Components/ResultTable.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { reactive } from 'vue';
    import { getDate } from '@/common';

    let data = reactive({
        data: []
    })

    const form = reactive({
        startDate: getDate(),
        endDate: getDate(),
        type: 'perDay'
    })

    const getData = async() => {
        try {
            await axios.get('api/analysis/', {
                params: {
                    startDate: form.startDate,
                    endDate: form.endDate,
                    type: form.type
                }
            })
            .then( res => {
                data.data = res.data.data
                data.labels = res.data.labels
                data.totals = res.data.totals
                data.type = res.data.type
            })
        } catch(e) {
            console.log(e.message)
        }
    }

</script>

<template>
    <Head title="データ分析" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">データ分析</h2>
        </template>

        <form @submit.prevent="getData">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            <div class="container py-4">
                                <div class="leading-7 text-sm text-gray-600">category</div>
                                <label class="ml-2">date<input type="radio" name="type" v-model="form.type" value="perDay" checked class="ml-2"></label>
                                <label class="ml-2">month<input type="radio" name="type" v-model="form.type" value="perMonth" class="ml-2"></label>
                                <label class="ml-2">year<input type="radio" name="type" v-model="form.type" value="perYear" class="ml-2"></label>
                                <label class="ml-2">decile<input type="radio" name="type" v-model="form.type" value="decile" class="ml-2"></label>
                            </div>

                            <label>開始日<input type="date" name="startDate" v-model="form.startDate" class="mx-4"></label>
                            <label>終了日<input type="date" name="endDate" v-model="form.endDate" class="ml-4"></label>
                            <button class="ml-4 text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索</button>

                            <div v-show="data.data.length">
                                <Chart :data="data"></Chart>
                                <ResultTable :data="data"></ResultTable>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
