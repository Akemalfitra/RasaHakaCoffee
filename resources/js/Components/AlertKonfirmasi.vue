<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3'; // Import useForm dari Inertia.js
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  data: {
    required: true
    },
rute: {
    required: true
  }
});

const showModal = ref(false);

const form = useForm({
  id: props.data.id
});

const confirmUserDeletion = () => {
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
};

const deleteUser = () => {
  form.post(route(props.rute), {
    preserveState: true,
    onSuccess: () => {
      showModal.value = false;
    }
  });
};
</script>

<template>
  <section class="space-y-6">

    <DangerButton @click="confirmUserDeletion">Hapus</DangerButton>


    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-medium text-gray-900">
          Apakah Anda yakin ingin menghapus {{ props.data.nama }}?
        </h2>

        <div class="mt-6 flex justify-end">
          
          <SecondaryButton @click="closeModal">
            Batalkan
          </SecondaryButton>
          
          <DangerButton @click="deleteUser" class="ms-3">
            Hapus
          </DangerButton>
        </div>
      </div>
    </Modal>
  </section>
</template>
