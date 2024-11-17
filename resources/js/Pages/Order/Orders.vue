<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import Alert from '../../Components/AlertKonfirmasi.vue';
import { defineComponent } from 'vue';
import { defineProps } from 'vue';
import { computed } from 'vue';

defineComponent({
  PrimaryButton,
  Link,
  Alert
})

defineProps({
  data: {
    type : Object,
    required : true
  },
  rute: {
    type : Array,
    required : true
  }
})

const userRole = computed(() => usePage().props.auth.user.role);

const formatDate = (date) => {
  return new Intl.DateTimeFormat('id-ID', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  }).format(new Date(date));
};
</script>

<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <div v-for="item in data" :key="item.id">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dd class="font-medium text-gray-900">ID Pesanan : {{ item.id }}</dd>
          <dd class="font-medium text-gray-900">Atas nama : {{ item.user.name }}</dd>
          <dd class="font-medium text-gray-900">Email pemesan : {{ item.user.email }}</dd>
          <dd class="font-medium text-gray-900">Tanggal di pesan : {{ formatDate(item.user.created_at) }}</dd>
          <dd class="font-medium text-gray-900">Status Pesanan : {{ item.order_status }}</dd>
        </div>

        <dd class="font-bold text-lg p-3">Total bayar : Rp {{ item.total_harga }},-</dd>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-2">
              <div class="flex gap-2">
                <Link
                  :href="route(rute[1])"
                  :data="{ id: item.id }"
                  as="button"
                  method="post"
                >
                  <PrimaryButton
                    :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status)"
                    :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status) ? 'cursor-not-allowed opacity-50' : ''"
                  >
                    Batalkan Pesanan
                  </PrimaryButton>
                </Link>

                <Link
                  :href="route(rute[0])"
                  :data="{ id: item.id}"
                  as="button"
                  method="get"
                >
                  <PrimaryButton>Rincian Pesanan</PrimaryButton>
                </Link>
              </div>


              <div v-if="userRole === 'admin'" class="flex gap-2">
                <!-- Proses Pesanan Button -->
                <Link
                  :href="route(rute[2])"
                  :data="{ id: item.id }"
                  as="button"
                  method="post"
                >
                  <PrimaryButton
                    :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status)"
                    :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status) ? 'cursor-not-allowed opacity-50' : ''"
                  >
                    Proses Pesanan
                  </PrimaryButton>
                </Link>

                <!-- Pesanan Selesai Button -->
                <Link
                  :href="route(rute[3])"
                  :data="{ id: item.id }"
                  as="button"
                  method="post"
                >
                  <PrimaryButton
                    :disabled="item.order_status !== 'Pesanan diproses'"
                    :class="item.order_status !== 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
                  >
                    Pesanan Selesai
                  </PrimaryButton>
                </Link>
              </div>
            <!-- </div> -->

            <!-- Admin: Hapus Pesanan Button -->
            <div v-if="userRole === 'admin'">
                <Alert :data="item" :rute="'admin.pesanan.hapus'" v-if="item.order_status === 'Pesanan selesai'" class="p-3" />
            </div>

          </div>
       
      </div>
    </dl>
  </div>
</template>

