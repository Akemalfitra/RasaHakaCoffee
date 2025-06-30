<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

// Mendefinisikan props
const props = defineProps({
  pesanan: Array,
  order: Array,
});

// Fungsi untuk kembali ke halaman sebelumnya
const goBack = () => {
  window.history.back();
};

</script>

<template>
    <Head title="Rincian pesanan" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Rincian pesanan
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <ul>
                            <li v-for="(order, index) in pesanan" :key="order.id">  
                                <div class="flow-root rounded-lg border border-gray-100 py-3 shadow-sm">
                                    <dl class=" divide-gray-100 text-sm">
                                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                            <dt class="font-medium text-gray-900">{{order.product.nama}}</dt>
                                            <dt class="font-medium text-gray-900">x{{order.quantity}}</dt>
                                            <dt class="font-medium text-gray-900">Rp {{order.product.harga}}</dt>
                                        </div>
                                    </dl>
                                </div>
                            </li>
                            <div>
                                <h1 class="p-2 py-5 font-extrabold text-xl">Total bayar :  Rp {{ order[0].total_harga }},-</h1>
                            </div>
                            <div class="py-3">
                                <PrimaryButton
                                    @click="goBack"
                                        >Kembali
                                </PrimaryButton>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
