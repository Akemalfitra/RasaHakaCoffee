<template>
  <div class="relative">
    <div class="inline-flex items-center overflow-hidden rounded-md border bg-white">

        <!-- button -->
      <button @click="toggleElement" class="h-full p-2 text-gray-600 hover:bg-gray-50 hover:text-gray-700">
        <span class="sr-only">Menu</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="size-4"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
            clip-rule="evenodd"
          />
        </svg>
      </button>
    </div>

    <!-- menu dropdown -->
    <div
      v-bind:hidden="!showElement"    
      class="absolute z-10 mt-2  rounded-md border border-gray-100 bg-white shadow-lg"
      role="menu"
    >
      <div class="p-2">
        <Link
          :href="route('admin.pesanan.batalkan')"
          as="button"
          method="post"
          :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status)"
          :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status) ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
          >
          Batalkan Pesanan
      </Link>
  
        <Link
          :href="route('rincian.admin')"
          :data="{id : data.id}"
          as="button"
          method="get"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Rincian Pesanan
        </Link>
  
        <Link
          :href="route('admin.pesanan.proses')"
          :data="{id : data.id}"
          as="button"
          method="post"
          :disabled="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status)"
          :class="['Dibatalkan pembeli', 'Dibatalkan penjual', 'Pesanan diproses', 'Pesanan selesai'].includes(data.order_status) ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Proses Pesanan
        </Link>
  
        <Link
          :href="route('admin.pesanan.selesai')"
          :data="{id : data.id}"
          as="button"
          method="post"
          :disabled="data.order_status !== 'Pesanan diproses'"
          :class="data.order_status !== 'Pesanan diproses' ? 'cursor-not-allowed opacity-50' : ''"
          class="block w-full text-start rounded-lg px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 hover:text-gray-700"
          role="menuitem"
        >
          Pesanan Selesai
        </Link>
  
          <Link
            v-if="data.order_status === 'Pesanan selesai'"
            :href="route('admin.pesanan.hapus')"
            :data="{id : data.id}"
            as="button"
            method="post"
            class="flex items-center  gap-2 rounded-lg px-4 py-2 text-sm text-red-700 hover:bg-red-50"
            role="menuitem"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="size-4"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
              stroke-width="2"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
  
            Hapus Pesanan
          </Link>
      </div>
    </div>

  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {
      showElement: false ,
    }
  },
  methods: {
    toggleElement() {
      this.showElement = !this.showElement;
    }
  },
  props: {
    data: Object
  },
  components: {
    Link
  }
}
</script>