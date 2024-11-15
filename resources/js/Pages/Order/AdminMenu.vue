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
import { Link } from '@inertiajs/vue3';

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
