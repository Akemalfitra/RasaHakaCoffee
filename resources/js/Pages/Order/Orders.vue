<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { computed, defineProps } from 'vue';
import dropdown from './dropdown.vue';

// Definisikan props yang diterima oleh komponen
const props = defineProps({
  data: {
    type: Array,  // Menggunakan Array karena data adalah array dalam template
    required: true
  },
  rute: {
    type: Array,
    required: true
  }
});

// Ambil informasi userRole dari halaman
const userRole = computed(() => usePage().props.auth.user.role);

// Fungsi format tanggal
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
    <dl class="divide-gray-100 text-sm">
      <div v-for="item in data" :key="item.id">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dd class="font-medium text-gray-900">ID Pesanan : {{ item.id }}</dd>
          <dd class="font-medium text-gray-900">Atas nama : {{ item.user.name }}</dd>
          <dd class="font-medium text-gray-900">Email pemesan : {{ item.user.email }}</dd>
          <dd class="font-medium text-gray-900">Tanggal di pesan : {{ formatDate(item.user.created_at) }}</dd>
          <dd class="font-medium text-gray-900">Status Pesanan : {{ item.order_status }}</dd>

          <!-- Menampilkan dropdown jika role adalah admin -->
          <dropdown v-if="userRole === 'admin'" class="absolute" :data="item" />
        </div>
        
        <dd class="font-bold text-lg p-3">Total bayar : Rp {{ item.total_harga }},-</dd>

        <!-- Jika role adalah user, tampilkan tombol-tombol berikut -->
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-2" v-if="userRole === 'user'">
          <div class="flex gap-2">
            <Link>
              <PrimaryButton
                @click="showAlert(item)"
                :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status)"
                :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(item.order_status) ? 'cursor-not-allowed opacity-50' : ''"
              >
                Batalkan Pesanan
              </PrimaryButton>
            </Link>

            <Link :href="route('rincian')" :data="{ id: item.id }" as="button" method="get">
              <PrimaryButton>Rincian Pesanan</PrimaryButton>
            </Link>
          </div>
        </div>
      </div>
    </dl>
  </div>
</template>

<script>
export default {
  methods: {
    async showAlert(item) {
      try {
        const result = await Swal.fire({
          title: "Batalkan Pesanan",
          text: `Apakah anda ingin membatalkan pesanan ini ?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batalkan',
        });

        if (result.isConfirmed) {
          await this.deleteMenu(item);
        }
      } catch (error) {
        console.error('Error showing alert:', error);
      }
    },

    async deleteMenu(item) {
      try {
        if (!item || !item.id) {
          throw new Error('Data ID is missing.');
        }

        const response = await this.$inertia.post(route('user.pesanan.batalkan', { id: item.id }));

        await Swal.fire({
          title: 'Dihapus!',
          text: `Pesanan berhasil dihapus.`,
          icon: 'success',
        });

        this.onFinish();
      } catch (error) {
        await Swal.fire({
          title: 'Error!',
          text: error.response?.data.message || 'There was an issue deleting the menu.',
          icon: 'error',
        });

        this.onFinish();
      }
    },

    async onFinish() {
      // Placeholder untuk logika selesai jika diperlukan
    }
  }
}
</script>
