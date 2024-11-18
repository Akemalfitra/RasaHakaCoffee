<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, usePage } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import { defineProps } from 'vue';
import { computed } from 'vue';
import dropdown from './dropdown.vue';

defineComponent({
  PrimaryButton,
  Link,
  dropdown
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
    <dl class=" divide-gray-100 text-sm">
      <div v-for="item in data" :key="item.id">
        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
          <dd class="font-medium text-gray-900">ID Pesanan : {{ item.id }}</dd>
          <dd class="font-medium text-gray-900">Atas nama : {{ item.user.name }}</dd>
          <dd class="font-medium text-gray-900">Email pemesan : {{ item.user.email }}</dd>
          <dd class="font-medium text-gray-900">Tanggal di pesan : {{ formatDate(item.user.created_at) }}</dd>
          <dd class="font-medium text-gray-900">Status Pesanan : {{ item.order_status }}</dd>
          <dropdown class="absolute" :data="item" v-if="userRole === 'admin'"></dropdown>
        </div>
        
        <dd class="font-bold text-lg p-3">Total bayar : Rp {{ item.total_harga }},-</dd>

          <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-2" v-if="userRole === 'user'" >
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
          </div>

      </div>
    </dl>
  </div>
</template>

<script>
export default {
  methods: {
    async showAlert() {
      try {
        const result = await Swal.fire({
          title: "Hapus",
          text: `Apakah anda ingin menghapus pesanan ?`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya',
          cancelButtonText: 'Batalkan',
        });

        if (result.isConfirmed) {
          await this.deleteMenu();
        }
      } catch (error) {
        console.error('Error showing alert:', error);
      }
    }
  }
}
</script>

