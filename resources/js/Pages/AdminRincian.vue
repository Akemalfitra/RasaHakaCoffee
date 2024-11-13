<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Pesanan" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Mohon tunggu, pesanan anda sedang di proses.
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
                                    <dl class="-my-3 divide-y divide-gray-100 text-sm">
                                        <div class="grid grid-cols-1 gap-1 p-3 sm:grid-cols-3 sm:gap-4">
                                            <dt class="font-medium text-gray-900">{{order.product.nama}}</dt>
                                            <dt class="font-medium text-gray-900">x{{order.quantity}}</dt>
                                            <dt class="font-medium text-gray-900">Rp {{order.product.harga}}</dt>
                                        </div>
                                    </dl>
                                </div>
                            </li>
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

<script>
import Orders from './Order/Orders.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
    props: {
        pesanan : Array
    },
    components: {
        Orders,
        PrimaryButton,
    },
      methods: {
        goBack() {
            window.history.back(); // Kembali ke halaman sebelumnya
        }
    }
}
</script>
