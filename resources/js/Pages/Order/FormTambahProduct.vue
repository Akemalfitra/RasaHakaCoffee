<script setup>
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Swal from 'sweetalert2'; 

const form = useForm({
  nama: '',
  jenis: '',
  harga: '',
  gambar: null, 
});

const handleFileChange = (event) => {
  form.gambar = event.target.files[0]; 
};

const submit = () => {
  form.post(route('admin.tambah.products'), {
    onSuccess: () => {
      Swal.fire({
        icon: 'success',
        title: 'Product Added!',
        text: 'Your product has been successfully added.',
        showConfirmButton: true,
      });
      form.reset(); 
    },
    onError: (errors) => {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong, please try again.',
        showConfirmButton: true,
      });
    },
    onFinish: () => {
      Swal.fire({
        icon: 'success',
        title: 'Ditambahkan !',
        text: 'Berhasil menambahkan daftar  menu !.',
        showConfirmButton: true,
      });
    }
  });
};
</script>


<template>
  <section class="bg-gray-100">
    <div class="mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 gap-x-16 gap-y-8 lg:grid-cols-5">
        <div class="lg:col-span-2 lg:py-12">
          <p class="max-w-xl text-lg">
            Tambahkan menu baru.
          </p>
  
          <div class="mt-8">
            <span class="text-2xl font-bold text-yellow-600"> RM Simangat </span>
  
            <address class="mt-2 not-italic text-gray-500">Lhokseumawe, Hagu Barat Laut. </address>
          </div>
        </div>
  
        <div class="rounded-lg bg-white p-8 shadow-lg lg:col-span-3 lg:p-12">
          <form @submit.prevent="submit" class="space-y-4">
            <div>
              <label class="sr-only" for="nama">Nama menu</label>
              <input
                v-model="form.nama"
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                placeholder="Nama menu"
                type="text"
                name="nama"
              />
            </div>
  
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
              <div>
                <label class="sr-only" for="jenis">Jenis menu</label>
                <input
                  v-model="form.jenis"
                  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                  placeholder="Jenis menu"
                  type="text"
                  name="jenis"
                />
              </div>
  
              <div>
                <label class="sr-only" for="harga">Harga</label>
                <input
                  v-model="form.harga"
                  class="w-full rounded-lg border-gray-200 p-3 text-sm"
                  placeholder="Harga"
                  type="number"
                  name="harga"
                />
              </div>
            </div>
  
            <div>
              <label class="sr-only" for="gambar">Foto</label>
              <p class="py-3">Upload foto menu <span class="text-gray-400">(maksimal 2mb).</span></p>
              <input
                @change="handleFileChange"
                class="w-full rounded-lg border-gray-200 p-3 text-sm"
                type="file"
                name="gambar"
              />
            </div>
  
            <div class="mt-4">
              <PrimaryButton
                type="submit"
                class="inline-block  rounded-lg bg-black px-2 py-2 font-medium text-white sm:w-auto"
              >
                Tambah data
              </PrimaryButton>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>
