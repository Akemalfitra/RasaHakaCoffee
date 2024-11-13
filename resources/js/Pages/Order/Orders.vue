<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4" v-for="item in data">
        <dt class="font-medium text-gray-900">ID Pesananan = {{ item.id }}</dt>
        <dt class="font-medium text-gray-900">Atas nama = {{ item.user.name }}</dt>
        <dd class="text-gray-900 sm:col-span-2">Status Pesanan = {{ item.order_status }}</dd>
        <dd class="text-gray-900 sm:col-span-2">Total bayar = {{ item.total_harga }}</dd>
        <div class=" ">
          
          <Link 
          class="p-3"
            :href="route(batalkan)" 
            :data="{ id: item.id }"
            as="button"
            method="post"
          >
          <PrimaryButton
            :disabled="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual'"
            :class="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' ? 'cursor-not-allowed opacity-50' : ''"
          >
            Batalkan Pesanan
          </PrimaryButton>
        </Link>
          <Link 
          class="p-3"
            :href="route(rincian)"
            :data="{ id: item.id}"
            method="get"
          >
          <PrimaryButton>Rincian Pesanan</PrimaryButton>
        </Link>

        <div v-if="this.$page.props.auth.user.role == 'admin'">
          <Link 
          class="p-3"
            :href="route(batalkan)" 
            :data="{ id: item.id }"
            as="button"
            method="post"
          >
          <PrimaryButton
            :disabled="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual'"
            :class="item.order_status == 'dibatalkan pembeli' || item.order_status == 'dibatalkan penjual' ? 'cursor-not-allowed opacity-50' : ''"
          >
            Proses Pesanan
          </PrimaryButton>
        </Link>
          <Link 
          class="p-3"
            :href="route(rincian)"
            :data="{ id: item.id}"
            method="get"
          >
          <PrimaryButton
          class="bg-green-600"
          >Pesanan Selesai</PrimaryButton>
        </Link>
        </div>
          
        </div>
      </div>
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
    rincian: {
      required : true
    },
    batalkan: {
      required : true
    },
  }
}
</script>