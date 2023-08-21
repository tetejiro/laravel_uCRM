<script setup>
import { computed, reactive, ref } from 'vue';

  const props = defineProps(['customers', 'items'])

  function getDate() {
    let dates = new Date();
    let year = dates.getFullYear();
    let month = '0' + (dates.getMonth()+1);
    month = month.slice(-2);
    let day = '0' + dates.getDate();
    day = day.slice(-2);

    return year+"-"+month+"-"+day;
  }

  let form = reactive({
    date: getDate(),
    customer_id: null,
  })

  let itemList = ref([]);
  props.items.forEach(item => {
    item['quantity'] = 0;
    itemList.value.push(item);
  });

  const quantities = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

  let totalPrice = computed(() => {
    let num = 0;
    itemList.value.forEach(item => {
      num += item.price * item.quantity
    })
    return num
  })
</script>

<template>

  <div>日付</div>
  <input type="date" name="date" v-model="form.date">

  <div>会員名</div>
  <select name="customer_id" v-model="form.customer_id">
    <option value="null" selected>選択してください</option>
    <option v-for="customer in props.customers" :key="customer.id" :value="customer.id">
      {{ customer.id }}/{{ customer.name }}
    </option>
  </select>

  <div>商品名</div>
  <table>
    <tr>
      <th>id</th>
      <th>商品名</th>
      <th>値段</th>
      <th>数量</th>
      <th>小計</th>
    </tr>
    <tr v-for="item in itemList" :key="item.id">
      <td>{{ item.id }}</td>
      <td>{{ item.name }}</td>
      <td>{{ item.price }}</td>
      <td>
        <select name="quantity" v-model="item.quantity">
          <option v-for="num in quantities" :key="num" :value="num">
            {{ num }}
          </option>
        </select>
      </td>
      <td>{{ item.price * item.quantity }}</td>
    </tr>
  </table>

  <div>
    合計 : {{ totalPrice }}
  </div>
</template>