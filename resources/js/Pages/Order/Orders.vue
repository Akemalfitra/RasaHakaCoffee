<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <ul class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4" v-for="item in data">
        <li class="font-medium text-gray-900">ID Pesananan = {{ item.id }}</li>
        <li class="font-medium text-gray-900">Atas nama = {{ item.user.name }}</li>
        <li class="text-gray-900 sm:col-span-2">Status Pesanan = {{ item.order_status }}</li>
        <li class="text-gray-900 font-bold">Total bayar = {{ item.total_harga }}</li>
        <div class="flex gap-3 py-3">
          <Link 
            :href="route(rute[1])" 
            :data="{ id: item.id }"
            as="button"
            method="post"
          >
          <PrimaryButton
            :disabled="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' || item.order_status == 'Pesanan diproses'"
            :class="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' || item.order_status == 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
          >

            Batalkan Pesanan
          </PrimaryButton>
        </Link>
          <Link 
        
            :href="route(rute[0])"
            :data="{ id: item.id}"
            method="get"
          >
          <PrimaryButton>Rincian Pesanan</PrimaryButton>
        </Link>

        <div v-if="this.$page.props.auth.user.role == 'admin'" class="flex gap-3">
          <Link 
       
            :href="route(rute[2])" 
            :data="{ id: item.id }"
            as="button"
            method="post"
          >
          <PrimaryButton
            :disabled="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' || item.order_status == 'Pesanan diproses'"
            :class="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' || item.order_status == 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
          >
            Proses Pesanan
          </PrimaryButton>
        </Link>
          <Link       
            :href="route(rute[3])"
            :data="{ id: item.id}"
            as="button"
            method="post"
          >
          <PrimaryButton
          class="bg-green-600 hover:bg-green-700"
          >Pesanan Selesai</PrimaryButton>
        </Link>
          <Link       
            :href="route(rute[4])"
            :data="{ id: item.id}"
            as="button"
            method="post"
          >
          <PrimaryButton
          class="bg-red-600 hover:bg-red-700"
          >Pesanan Selesai</PrimaryButton>
        </Link>
        </div>
          
        </div>
      </ul>
    </dl>
  </div>

</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

export default {

  components: {
    PrimaryButton,
    Link
  },
  props: {
    data: {
      required : true
    },
    rute: {
      required : true
    }
  }
}
</script>

<!-- <style>
* {
  border: solid 1px
}
</style> -->