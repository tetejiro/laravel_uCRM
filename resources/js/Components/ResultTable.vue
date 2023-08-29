<script setup>
  defineProps(['data'])
</script>

<template>
  <div v-show="data.data">
    <section class="text-gray-600 body-font">
      <div class="container px-5 py-24 mx-auto">
        <div class="lg:w-2/3 w-full mx-auto overflow-auto">


          <div v-if="data.type == 'perDay' || data.type == 'perMonth' || data.type == 'perYear'">
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


          <div v-if="data.type == 'decile'">
            <table class="table-auto w-full text-left whitespace-no-wrap">
              <thead>
                <tr>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">group</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">average</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">sum</th>
                  <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">percent</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="item in data.data" :key="item.date">
                  <td class="px-4 py-3">{{ item.decile }}</td>
                  <td class="px-4 py-3">{{ item.average }}</td>
                  <td class="px-4 py-3">{{ item.totalPerGroup }}</td>
                  <td class="px-4 py-3">{{ item.totalRatio }}</td>
                </tr>
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </section>
  </div>


</template>