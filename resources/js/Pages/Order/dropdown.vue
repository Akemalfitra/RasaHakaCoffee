<template>
  <div class="relative">
    <div class="inline-flex items-center overflow-hidden rounded-md border bg-white">
      <!-- button -->
      <button @click="toggleElement" class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
        <span class="sr-only">Menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
        </svg>
      </button>
    </div>

    <!-- menu dropdown -->
    <div v-bind:hidden="!showElement" class="absolute z-10 mt-2 rounded-md border border-gray-100 bg-white shadow-lg" role="menu">
      <div class="p-2">
        <button
          @click="confirmAction('Batalkan Pesanan', 'admin/pesanan/batalkan')"
          :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status)"
          :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status) ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Batalkan Pesanan
        </button>

        <button
          @click="navigateTo('rincian.admin')"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Rincian Pesanan
        </button>

        <button
          @click="confirmAction('Proses Pesanan', 'admin/pesanan/proses')"
          :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status)"
          :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status) ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Proses Pesanan
        </button>

        <button
          @click="confirmAction('Pesanan Selesai', 'admin/pesanan/selesai')"
          :disabled="data.order_status !== 'Pesanan diproses'"
          :class="data.order_status !== 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Pesanan Selesai
        </button>

        <button
          v-if="data.order_status === 'Pesanan selesai' || data.order_status === 'Dibatalkan pembeli' || data.order_status === 'Dibatalkan penjual'"
          @click="confirmAction('Hapus Pesanan', 'admin/pesanan/hapus')"
          class="flex items-center gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
          role="menuitem"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
          </svg>
          Hapus Pesanan
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      showElement: false,
    };
  },
  methods: {
    toggleElement() {
      this.showElement = !this.showElement;
    },
    confirmAction(actionText, route) {
      Swal.fire({
        title: `${actionText}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, lanjutkan',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {
          this.$inertia.post(route, { id: this.data.id }).then(() => {
            
            Swal.fire({
              title: 'Berhasil!',
              text: `${actionText} telah berhasil dilakukan.`,
              icon: 'success',
              confirmButtonText: 'Tutup'
            });
          }).catch(() => {
            
            Swal.fire({
              title: 'Gagal!',
              text: 'Terjadi kesalahan. Silakan coba lagi.',
              icon: 'error',
              confirmButtonText: 'Tutup'
            });
          });
        }
      });
    },
    navigateTo(routeName) {
      this.$inertia.visit(this.route(routeName, { id: this.data.id })); 
    }
  },
  props: {
    data: Object
  },
  components: {
    Link
  }
};
</script>

