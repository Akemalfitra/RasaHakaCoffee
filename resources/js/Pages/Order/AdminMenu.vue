<template>
  <div class="block rounded-lg p-4 shadow-sm shadow-indigo-100">
    <img
      alt=""
      :src="'/img/products/' + data.gambar"
      class="h-56 w-full rounded-md object-cover"
    />
  
    <div class="mt-2">
      <dl>
        <div>
          <dt class="sr-only">Harga</dt>
          <dd class="text-sm text-gray-500">Rp {{ data.harga }}</dd>
        </div>
        <div>
          <dt class="sr-only">Nama</dt>
          <dd class="font-medium">{{ data.nama }}</dd>
        </div>
      </dl>
 
      <div class="mt-1.5 sm:mt-0">
        <dt class="text-gray-500">Jenis</dt>
        <dd class="font-medium">{{ data.jenis }}</dd>
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
        <Link
            :href="route('admin.menu.hapus')"
            :data="{ id: data.id}"
            as="button"
            method="post"
        >
          <PrimaryButton class="bg-red-600 hover:bg-red-700">Hapus</PrimaryButton>
        </Link>
      </div>
      </div>
    </div>
  </div>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

export default {
  components: {
    PrimaryButton,
    Link
  },
  props: {
    data: {
      required: true
    }
  }
};
</script>
