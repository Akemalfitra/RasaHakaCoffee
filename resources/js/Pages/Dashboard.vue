<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3'; // Menambahkan Link untuk tombol
// Bagian script setup ini dibiarkan untuk konsistensi, tidak ada logika baru yang ditambahkan di sini.
</script>

<template>
  <Head title="Daftar Menu - RasaHaka" />

  <AuthenticatedLayout>
    <template #header>
        <div>
            <a href="#" class="text-2xl font-bold text-yellow-600"> Rasahaka </a>
            <address class="mt-2 not-italic">Takengon, Aceh Indonesia.</address>
        </div>
    </template>

    <section
        class="relative flex h-[60vh] w-full items-center justify-center overflow-hidden bg-stone-900"
        aria-label="Selamat datang di RasaHaka"
    >
        <div class="absolute inset-0 z-10 bg-gradient-to-b from-stone-900/50 to-stone-900/80"></div>
        
        <img
            src="/img/rasahaka-up.jpg"
            alt="Suasana RasaHaka"
            class="absolute inset-0 h-full w-full object-cover opacity-70"
            aria-hidden="true"
        />
        
        <div class="relative z-20 px-4 text-center sm:px-6">
            <h1 class="mb-4 font-serif text-4xl font-extrabold text-white drop-shadow-xl sm:text-6xl md:text-7xl animate-fade-in">
                RasaHaka
            </h1>
            <p class="mb-8 font-sans text-lg font-semibold text-yellow-100 drop-shadow-lg sm:text-2xl">
            Nikmati Kopi dengan Cita Rasa Unik dari Tanah Aceh
            </p>
            <a
                href="#menu-list"
                class="inline-block rounded-lg bg-yellow-600 px-8 py-3 text-lg font-bold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:bg-yellow-700 animate-pulse-slow"
                aria-label="Lihat daftar menu"
            >
                Lihat Menu
            </a>
        </div>
    </section>

    <Cart 
      :cart="cart" 
      :isVisible="isCartVisible" 
      @close-cart="closeCart" 
      @remove-item="removeFromCart"
      @checkout="checkout"
      @clear="clear" 
    />

    <div id="menu-list" class="py-12 bg-stone-100">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

        <div class="pb-5 pr-4 md:pr-0">
            <a href="#" @click.prevent="openCart" 
              class="flex items-center justify-end text-lg font-semibold text-gray-700 transition duration-200 hover:text-green-700" > 
              Keranjang Anda ({{ cart.length }})
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-bag-check-fill ms-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                </svg>
            </a>
        </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 md:p-8">
            <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
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
// Tidak ada perubahan yang diperlukan pada logika komponen. Semuanya sudah bekerja dengan baik.
import Menu from './Order/Menu.vue';
import Cart from './Order/Cart.vue';
import { useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2'; 

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
      cart: this.loadCart(),
      isCartVisible: false,
    };
  },
    methods: {
    addToCart(product) {
      const existingProductIndex = this.cart.findIndex(item => item.id === product.id);

      if (existingProductIndex !== -1) {
        this.cart[existingProductIndex].quantity += 1;
      } else {
        this.cart.push({ ...product, quantity: 1 });
      }

      this.saveCart(); 
    },
  
    removeFromCart(index) {
      this.cart.splice(index, 1);
      this.saveCart(); 
    },
    
    saveCart() {
      localStorage.setItem('cart', JSON.stringify(this.cart));
    },
    
    loadCart() {
      const savedCart = localStorage.getItem('cart');
      return savedCart ? JSON.parse(savedCart) : [];  
    },
    
    openCart() {
      this.isCartVisible = true;
    },
    
    closeCart() {
      this.isCartVisible = false;
    },

    checkout() {
      
      const totalPrice = this.cart.reduce((total, item) => total + (item.harga * item.quantity), 0);

      const cartData = this.cart.map(item => ({
        productId: item.id,
        harga: item.harga,
        quantity: item.quantity,
      }));

      Swal.fire({
        title: 'Konfirmasi Pesanan',
        text: `Apakah Anda yakin ingin melanjutkan checkout? Total Harga: Rp ${totalPrice.toLocaleString('id-ID')}`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#16a34a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Lanjutkan Pesanan!',
        cancelButtonText: 'Batal',
      }).then((result) => {
        if (result.isConfirmed) {

          const form = useForm({
            userId: this.$page.props.auth.user.id,
            cart: cartData,
            jumlah: totalPrice,
          });

          form.post(route('checkout'), {
            onFinish: () => {
              Swal.fire({
                title: 'Pesanan Berhasil!',
                text: 'Pesanan Anda telah berhasil dibuat dan segera di proses.',
                icon: 'success',
                confirmButtonText: 'OK',
              });
              this.clear();  
              this.isCartVisible = false;
            },
          });
        }
      });
    },

    clear() {
      localStorage.removeItem('cart'); 
      this.cart.length = 0;
    }
  },
};
</script>

<style>
/* Menambahkan ini agar scroll ke #menu-list berjalan mulus */
html {
  scroll-behavior: smooth;
}

/* Menambahkan ini untuk animasi dari dashboard RasaHaka */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes pulseSlow {
  0%,
  100% {
    transform: scale(1);
  }
  50% {
    transform: scale(1.03);
  }
}

.animate-fade-in {
  animation: fadeIn 1s ease-out forwards;
}

.animate-pulse-slow {
  animation: pulseSlow 2.5s infinite ease-in-out;
}
</style>