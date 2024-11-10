<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Selamat datang di Website pemesanan online RM Simangat, Silahkan pesan menu favorit Anda.
      </h2>
    </template>

    <Cart 
      :cart="cart" 
      :isVisible="isCartVisible" 
      @close-cart="closeCart" 
      @remove-item="removeFromCart"
      @checkout="checkout"
      @clear="clear" 
    />

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

      <!-- Tombol untuk membuka modal -->
       <div class="pb-5">
         <a href="#" @click="openCart" class="flex hover:text-green-700 justify-end" > 
          Checkout pesanan anda disini ({{ cart.length }})
             <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
               <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
             </svg>
       
         </a>
       </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg flex">
          <div class="p-6 text-gray-900">
            <ul class="grid grid-cols-3 gap-6">
              <li v-for="product in products" :key="product.id">
                <Menu :data="product" @add-to-cart="addToCart" />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import Menu from './Order/Menu.vue';
import Cart from './Order/Cart.vue';
import { useForm } from '@inertiajs/vue3';

export default {
  props: {
    products: Array
  },
  components: {
    Menu,
    Cart
  },
  data() {
    return {
      cart: this.loadCart(),  // Memuat cart dari Local Storage
      isCartVisible: false,
    };
  },
  methods: {
    // Fungsi untuk menambah produk ke keranjang
    addToCart(product) {
      this.cart.push(product);
      this.saveCart();  // Simpan ke Local Storage setiap kali cart berubah
    },
    // Menghapus produk dari cart
    removeFromCart(index) {
      this.cart.splice(index, 1);
      this.saveCart();  // Simpan perubahan ke Local Storage
    },
    // Menyimpan cart ke Local Storage
    saveCart() {
      localStorage.setItem('cart', JSON.stringify(this.cart));
    },
    // Memuat cart dari Local Storage
    loadCart() {
      const savedCart = localStorage.getItem('cart');
      return savedCart ? JSON.parse(savedCart) : [];  // Kembalikan cart yang tersimpan atau array kosong
    },
    // Membuka modal cart
    openCart() {
      this.isCartVisible = true;
    },
    // Menutup modal cart
    closeCart() {
      this.isCartVisible = false;
    },
    checkout() {
       // Menggunakan useForm untuk membuat form data
      const form = useForm({
        cart: this.cart,  // Mengirim data cart ke controller
      });

      // Kirim form data ke route checkout
      form.post(route('checkout'), {
        onFinish: () => {
          this.clear();  // Kosongkan cart setelah checkout berhasil
        },
      });
    },
    clear() {
      this.cart.length = 0;
    }
  },
};
</script>
