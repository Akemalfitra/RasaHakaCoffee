<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt=""
      :src="'/img/products/' + data.gambar"
      class="h-56 w-full rounded-md object-cover"
    />
  

      <div>
        <h2 class="text-xl text-gray-500 py-1">{{ data.nama }}</h2>
      </div>

      <div class="py-2">
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
  
      <div class="mt-3 flex items-center gap-3 text-xs" v-if="$page.props.auth.user.role == 'admin'">
        <div class="flex gap-2 sm:shrink-0 sm:items-center sm:gap-2">
           <Link
            :href="route('admin.menu.edit')"
            :data="{ id: data.id}"
            as="button"
            method="get"
        >
          <PrimaryButton>Edit</PrimaryButton>
        </Link>

        <PrimaryButton
        @click="showAlert"
        >
          Hapus
        </PrimaryButton>

      </div>
      
    </div>  
  </div>

</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Alert from '../../Components/AlertKonfirmasi.vue';
import { Link } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

export default {
  components: {
    PrimaryButton,
    Link,
    Alert
  },
  props: {
    data: {
      required: true
    }
  },
  methods: {
  
  async showAlert() {
    try {
      const result = await Swal.fire({
        title: "Hapus",
        text: `Apakah anda ingin menghapus menu ${this.data?.nama} ?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batalkan',
      });

      if (result.isConfirmed) {
        await this.deleteMenu(); 
      }
    } catch (error) {
      console.error('Error showing alert:', error);
    }
  },


  async deleteMenu() {
    try {

      if (!this.data || !this.data.id) {
        throw new Error('Data ID is missing.');
      }


      const response = await this.$inertia.post(route('admin.menu.hapus', { id: this.data.id }));


      await Swal.fire({
        title: 'Dihapus!',
        text: `Menu ${this.data?.nama} berhasil dihapus.`,
        icon: 'success',
      });


      this.onFinish();
    } catch (error) {

      await Swal.fire({
        title: 'Error!',
        text: error.response?.data.message || 'There was an issue deleting the menu.',
        icon: 'error',
      });

      this.onFinish();
    }
  },

  async onFinish() {
    
  },
}

};
</script>
