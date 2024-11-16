<template>
  <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
    <dl class="-my-3 divide-y divide-gray-100 text-sm">
      <div v-for="item in data" :key="item.id">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dd class="font-medium text-gray-900">ID Pesanan : {{ item.id }}</dd>
          <dd class="font-medium text-gray-900">Atas nama : {{ item.user.name }}</dd>
          <dd class="font-medium text-gray-900">Email pemesan : {{ item.user.email }}</dd>
          <!-- Menggunakan Intl.DateTimeFormat untuk format tanggal -->
          <dd class="font-medium text-gray-900">Tanggal di pesan : {{ formatDate(item.user.created_at) }}</dd>
          <dd class="font-medium text-gray-900">Status Pesanan : {{ item.order_status }}</dd>
          <dd class="text-gray-900 font-bold text-lg">Total bayar : Rp {{ item.total_harga }},-</dd>

          <div class="flex-wrap sm:flex gap-3 sm:col-span-4 justify-start">
            <div class="flex gap-3 py-5">
              <div class="flex gap-2">
                <!-- Batalkan Pesanan Button -->
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

                <!-- Rincian Pesanan Button -->
                <Link
                  :href="route(rute[0])"
                  :data="{ id: item.id}"
                  as="button"
                  method="get"
                >
                  <PrimaryButton>Rincian Pesanan</PrimaryButton>
                </Link>
              </div>

              <!-- Admin Controls -->
              <div v-if="userRole === 'admin'" class="flex gap-3">
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
            </div>

            <!-- Admin: Hapus Pesanan Button -->
            <div v-if="userRole === 'admin'" class="flex mt-3">
                <Alert :data="item" :rute="'admin.pesanan.hapus'" v-if="item.order_status === 'Pesanan selesai'"/>
            </div>

          </div>

        </div>
      </div>
    </dl>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import Alert from '../../Components/AlertKonfirmasi.vue';

export default {
  components: {
    PrimaryButton,
    Link,
    Alert
  },
  props: {
    data: {
      required: true
    },
    rute: {
      required: true
    }
  },
  computed: {
    userRole() {
      return usePage().props.auth.user.role;
    }
  },
  methods: {
    formatDate(date) {
      return new Intl.DateTimeFormat('id-ID', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      }).format(new Date(date));
    }
  }
}
</script>
