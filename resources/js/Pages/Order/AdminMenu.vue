<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt=""
      :src="'/storage/img/products/' + data.gambar"
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
            <dd class="text-sm text-gray-500">Rp {{ data.harga }}/porsi</dd>
          </div>
          <div>
            <dt>Jenis</dt>
            <dd class="text-sm text-gray-500">{{ data.jenis }}</dd>
          </div>
        </dl>
      </div>
  
      <div class="mt-6 flex items-center gap-3 text-xs">
        <div class="flex gap-2 sm:shrink-0 sm:items-center sm:gap-2">
           <Link
            :href="route('admin.pesanan.edit')"
            :data="{ id: data.id}"
            as="button"
            method="get"
        >
          <PrimaryButton>Edit</PrimaryButton>
        </Link>

        <PrimaryButton
        @click="showAlert"
          >Hapus</PrimaryButton>

      </div>
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
  // Show confirmation alert to delete menu
  async showAlert() {
    try {
      const result = await Swal.fire({
        title: `Apakah anda ingin menghapus menu ${this.data?.nama} ?`,
        text: '',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
      });

      if (result.isConfirmed) {
        await this.deleteMenu();  // Proceed to delete the menu if confirmed
      }
    } catch (error) {
      console.error('Error showing alert:', error);
    }
  },

  // Handle menu deletion
  async deleteMenu() {
    try {
      // Validate that this.data and this.data.id are defined before making a request
      if (!this.data || !this.data.id) {
        throw new Error('Data ID is missing.');
      }

      // Perform the deletion request using Inertia
      const response = await this.$inertia.post(route('admin.menu.hapus', { id: this.data.id }));

      // Show success alert upon successful deletion
      await Swal.fire({
        title: 'Deleted!',
        text: 'Menu berhasil dihapus.',
        icon: 'success',
      });

      // Call onFinish after deletion is confirmed
      this.onFinish();
    } catch (error) {
      // Show error alert in case of failure
      await Swal.fire({
        title: 'Error!',
        text: error.response?.data.message || 'There was an issue deleting the menu.',
        icon: 'error',
      });

      // Call onFinish after error is displayed
      this.onFinish();
    }
  },

  // Final alert after delete operation completes (either success or error)
  async onFinish() {
    
  },
}

};
</script>
