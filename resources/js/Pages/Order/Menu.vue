<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt="Gambar"
      :src="`/img/products/${data.gambar}`"
      class="h-56 w-full rounded-md object-cover"
    />
  
    <div class="mt-2">
      <div>
        <h2 class="text-xl text-gray-500">{{ data.nama }}</h2>
      </div>

      <div class="py-3">
        <dl class="flex gap-10">
          <div>
            <dt>Harga</dt>
            <dd class="text-sm text-gray-500">Rp {{ data.harga }}/cup</dd>
          </div>
          <div>
            <dt>Jenis</dt>
            <dd class="text-sm text-gray-500">{{ data.jenis }}</dd>
          </div>
        </dl>
      </div>

        <div class="pt-3">
          <PrimaryButton @click="addToCart(data)">Pesan</PrimaryButton>
      </div>

    </div>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Swal from 'sweetalert2'; 

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
    addToCart() {

      Swal.fire({
        position: "top-end",
        icon: "success",
        title: 'Ditambakan ke keranjang!',
        text: `${this.data.nama} telah ditambahkan ke keranjang.`,
        showConfirmButton: false,
        timer: 700
      });

      this.$emit('add-to-cart', this.data);
    }
  }
};
</script>
