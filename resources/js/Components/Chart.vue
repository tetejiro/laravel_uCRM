<script setup>
  import { Chart, registerables } from "chart.js";
  import { BarChart } from "vue-chart-3";
  import { computed, onMounted, reactive } from "vue"


  const props = defineProps({data: Object})

  Chart.register(...registerables);

  const labels = computed(() => props.data.labels)
  const totals = computed(() => props.data.totals)

  const barData = reactive({
    labels: labels,
    datasets: [
      {
        label: '売上',
        data: totals,
        backgroundColor: "rgb(75, 192, 192)",
        tension: 0.1,
      }
    ]
  })


</script>

<template>
  <div v-show="data">
    <BarChart :chartData="barData"></BarChart>
  </div>
</template>