<template>
  <div v-if="isVisible" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl w-96 max-w-lg">
      <p v-show="cart.length == 0" class=" text-gray-500 fw-light text-center py-5">Anda belum memasukkan pesanan apapun ke dalam keranjang !</p>
      <p v-show="cart.length > 0" class="text-lg font-semibold pb-3 text-center">Keranjang pesanan</p>

      <!-- Daftar Item di Keranjang -->
      <ul class="space-y-4">
        <li v-for="(item, index) in cart" :key="item.id" class="flex justify-between items-center">
          <span class="py-2">{{ item.nama }} - Rp. {{ item.harga }} - x{{ item.quantity }}</span> 
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

      <!-- Atas nama -->

      <div v-show="cart.length > 0" class="mt-4 border-t pt-4 flex flex-col items-center">
        
        <label class="block text-gray-700 text-sm font-medium mb-2" for="atasNama">
          Atas Nama
        </label>
        <input
          id="atasNama"
          v-model="atasNama"
          required
          type="text"
          placeholder="Masukkan nama pemesan"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200 text-base"
        />
      
      </div>
      <div v-show="cart.length > 0" class="mt-4 border-t pt-4">
        <p class="text-lg font-semibold">Total: Rp. {{ totalPrice }}</p>
      </div>

      <!-- Tombol untuk Tutup Modal -->
      <div class="mt-4 flex space-x-4">
        <PrimaryButton @click="closeCart">Tutup</PrimaryButton>
        <PrimaryButton 
          v-show="cart.length > 0" 
          @click="checkout" 
          class="bg-green-600 hover:bg-green-700">
          Konfirmasi Pesanan
        </PrimaryButton>
      </div>
      <button
        v-show="cart.length > 0"
        @click="clear()" 
        class="pt-5 text-dark rounded-lg text-gray-400 hover:text-gray-500 transition duration-200 fw-light"
      >
        <i>Bersihkan keranjang pesanan</i>
      </button>
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
    cart: {
      type: Array,
      required: true,
    },
    isVisible: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      atasNama: ''
    };
  },
  computed: {
    totalPrice() {
      return this.cart.reduce((total, item) => total + (item.harga * item.quantity), 0);
    }
  },
    methods: {
      removeFromCart(index) {
        this.$emit('remove-item', index); 
    },
  
    closeCart() {
      this.$emit('close-cart');
      },
      checkout() {
      this.$emit('checkout', this.totalPrice, this.atasNama); 
      },
      clear() {
        this.$emit('clear')
    }
  }
};
</script>


