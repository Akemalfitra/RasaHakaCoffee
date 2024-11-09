<template>
  <div v-if="isVisible" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 max-w-lg">
      <h2 class="text-2xl font-semibold mb-4">Keranjang Belanja</h2>

      <!-- Daftar Item di Keranjang -->
      <ul class="space-y-4">
        <li v-for="(item, index) in cart" :key="item.id" class="flex justify-between items-center">
          <span>{{ item.nama }} - Rp. {{ item.harga }}</span>
          <button 
            @click="removeFromCart(index)" 
            class="text-red-500 hover:text-red-600"
          >
            Hapus
          </button>
        </li>
      </ul>

      <!-- Total Harga -->
      <div v-if="cart.length > 0" class="mt-4 border-t pt-4">
        <p class="text-lg font-semibold">Total: Rp. {{ totalPrice }}</p>
      </div>

      <!-- Tombol untuk Tutup Modal -->
      <div class="mt-4 flex justify-end space-x-4">
        <button 
          @click="closeCart" 
          class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition duration-200"
        >
          Tutup
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
    return this.cart.reduce((total, item) => total + Number(item.harga), 0);
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
  }
};
</script>

<style scoped>
/* Add additional styles if needed */
</style>
