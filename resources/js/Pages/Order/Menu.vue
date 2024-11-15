<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt=""
      :src="'/img/products/' + data.gambar"
      class="h-56 w-full rounded-md object-cover"
    />
  
    <div class="mt-2">
      <dl>
        <div>
          <dt class="sr-only">Price</dt>
          <dd class="text-sm text-gray-500">Rp {{ data.harga }}</dd>
        </div>
        <div>
          <dt class="sr-only">Address</dt>
          <dd class="font-medium">{{ data.nama }}</dd>
        </div>
      </dl>
  
      <div class="mt-6 flex items-center gap-8 text-xs">
        <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
          <svg class="size-4 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
          </svg>
          <div class="mt-1.5 sm:mt-0">
            <p class="text-gray-500">Jenis</p>
            <p class="font-medium">{{ data.jenis }}</p>
          </div>
        </div>
            <PrimaryButton @click="addToCart(data)">Pesan</PrimaryButton>
      </div>
    </div>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
  components: {
    PrimaryButton
  },
  props: {
    data: {
      required: true
    }
  },
  methods: {
    // Emit event ketika produk ditambahkan ke keranjang
    addToCart() {
      this.$emit('add-to-cart', this.data); // Kirim data produk ke parent
    }
  }
};
</script>
