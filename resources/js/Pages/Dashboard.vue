<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
  <Head title="Daftar menu" />

  <AuthenticatedLayout>
    <template #header>
          <div>
            <a href="#" class="text-2xl font-bold text-yellow-600"> RM Simangat </a>
            <address class="mt-2 not-italic">Lhokseumawe, Hagu Barat Laut.</address>
          </div>
    </template>

  <div class="relative w-full sm:h-64 h-36 overflow-hidden">
    <img src="img/background.jpg" alt="" class="w-full sm:h-auto h-64 overflow-hidden">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
      <h1 class="text-xl font-semibold leading-tight text-white">
        RM Simangat
      </h1>
      <h2 class="sm:text-xl text-sm font-semibold leading-tight text-white">
        Nikmati Hidangan Spesial Kami, Rasakan Kelezatan Disetiap Gigitannya Simangat Bertoh-Mangat.
      </h2>
    </div>
  </div>

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
         <a href="#" @click="openCart" 
         class="flex hover:text-green-700 justify-end transition duration-200 " > 
          Konfirmasi pesanan anda disini ({{ cart.length }})
             <svg xmlns="http://www.w3.org/2000/svg" width="30" height="20" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
               <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
             </svg>
         </a>
       </div>

        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg flex">
          <div class="p-6 text-gray-900">
            <ul class="grid sm:grid-cols-2 gap-6 grid-cols-1 md:grid-cols-3">
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

      const form = useForm({
        userId: this.$page.props.auth.user.id,
        cart: cartData,  
        jumlah: totalPrice
      });

      form.post(route('checkout'), {
        onFinish: () => {
          this.clear(); 
        },
      });
    },
    clear() {
        
        localStorage.removeItem('cart'); 
        this.cart.length = 0;
        this.isCartVisible = false;
    }
  },
};
</script>
