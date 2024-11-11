<template>
  <div v-if="isVisible" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 max-w-lg">
      <p v-if="cart.length == 0" class=" text-gray-500 fw-light">Anda belum memasukkan pesanan apapun ke dalam keranjang !</p>

      <!-- Daftar Item di Keranjang -->
      <ul class="space-y-4">
        <li v-for="(item, index) in cart" :key="item.id" class="flex justify-between items-center">
          <span>{{ item.nama }} - Rp. {{ item.harga }} - x{{ item.quantity }}</span>
          <button 
            @click="removeFromCart(index)" 
            class="text-red-300 hover:text-red-600"
          >
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive" viewBox="0 0 16 16">
              <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
            </svg>
          </button>
        </li>
      </ul>

      <!-- Total Harga -->
      <div v-if="cart.length > 0" class="mt-4 border-t pt-4">
        <p class="text-lg font-semibold">Total: Rp. {{ totalPrice }}</p>
      </div>

      <!-- Tombol untuk Tutup Modal -->
      <div class="mt-4 flex space-x-4">
        <button 
          @click="closeCart" 
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200"
        >
          Tutup
        </button>
        <button 
          @click="checkout" 
          class="px-4 py-2 bg-green-700 text-white rounded-lg hover:bg-green-800 transition duration-200"
        >
          Checkout
        </button>
        <button
          @click="clear()" 
          class="pl-8 py-2 text-dark rounded-lg hover:text-red-800 transition duration-200"
        >
          Bersihkan
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // Terima cart dan visibilitas modal dari parent
    cart: {
      type: Array,
      required: true,
    },
    isVisible: {
      type: Boolean,
      required: true,
    },
  },
  computed: {
    // Menghitung total harga
    totalPrice() {
      return this.cart.reduce((total, item) => total + (item.harga * item.quantity), 0);
    }
  },
    methods: {
    // Menghapus item dari cart berdasarkan index
    removeFromCart(index) {
      this.$emit('remove-item', index); // Emit event ke parent untuk menghapus item
    },
    // Menutup modal
    closeCart() {
      this.$emit('close-cart');  // Emit event untuk menutup modal
      },
      checkout() {
      this.$emit('checkout', this.totalPrice); // Emit event untuk melakukan checkout
      },
      clear() {
        this.$emit('clear')
    }
  }
};
</script>
