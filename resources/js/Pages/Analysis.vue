<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import Chart from '@/Components/Chart.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    import { reactive } from 'vue';

    function getDate() {
        let dates = new Date();
        let year = dates.getFullYear();
        let month = '0' + (dates.getMonth() + 1);
        month = month.slice(-2);
        let day = '0' + dates.getDate();
        day = day.slice(-2);

        return year + "-" + month + "-" + day;
    }

    let data = reactive({
        data: []
    })
    console.log(data.data.length)


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
            })
        } catch(e) {
            console.log(e.message)
        }
    }


    const form = reactive({
        startDate: getDate(),
        endDate: getDate(),
        type: 'perDay'
    })
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

                            <label>開始日<input type="date" name="startDate" v-model="form.startDate" class="mx-4"></label>
                            <label>終了日<input type="date" name="endDate" v-model="form.endDate" class="ml-4"></label>
                            <button class="ml-4 text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">検索</button>


                            <div v-show="data.data.length">
                                <Chart :data="data"></Chart>
                            </div>


                            <div v-show="data.data">
                                <section class="text-gray-600 body-font">
                                    <div class="container px-5 py-24 mx-auto">
                                        <div class="lg:w-2/3 w-full mx-auto overflow-auto">
                                        <table class="table-auto w-full text-left whitespace-no-wrap">
                                            <thead>
                                                <tr>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">date</th>
                                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="item in data.data" :key="item.date">
                                                    <td class="px-4 py-3">{{ item.date }}</td>
                                                    <td class="px-4 py-3">{{ item.total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                </section>
                            </div>





                        </div>
                    </div>
                </div>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
