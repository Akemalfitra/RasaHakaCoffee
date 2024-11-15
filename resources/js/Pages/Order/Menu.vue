<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt="Gambar"
      :src="'/img/products/' + data.gambar"
      class="h-56 w-full rounded-md object-cover"
    />
  
    <div class="mt-2">
      <dl>
        <div>
          <dt class="sr-only">Harga</dt>
          <dd class="font-medium">{{ data.nama }}</dd>
        </div>
        <div>
          <dt class="sr-only">Nama</dt>
          <dd class="text-sm text-gray-500">Rp {{ data.harga }}</dd>
        </div>
        <div>
          <dt class="sr-only">Jenis</dt>
          <dd class="text-sm text-gray-500">{{ data.jenis }}</dd>
        </div>

      </dl>

        <div class="py-3">
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
