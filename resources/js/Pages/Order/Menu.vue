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
            <p class="text-gray-500">Stok</p>
            <p class="font-medium">{{ data.stok }}</p>
          </div>
        </div>

        <!-- Tombol untuk menambah ke keranjang -->
        <button class="flex justify-end">
          <strong
            class="-mb-[2px] -me-[2px] inline-flex items-center gap-1 rounded-ee-xl rounded-ss-xl bg-green-600 px-3 py-1.5 text-white"
          >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M8 7.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V12a.5.5 0 0 1-1 0v-1.5H6a.5.5 0 0 1 0-1h1.5V8a.5.5 0 0 1 .5-.5"/>
              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
            </svg>
          
            <button 
              class="text-[10px] font-medium sm:text-xs"
              @click="addToCart(data)"
            >
              Tambahkan ke keranjang
            </button>
          </strong>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
