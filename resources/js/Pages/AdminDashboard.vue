<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
            <template #header>
                <div>
                    <a href="#" class="text-2xl font-bold text-yellow-600"> Admin RM Simangat </a>
                    <address class="mt-2 not-italic">Lhokseumawe, Hagu Barat Laut.</address>
                </div>
            </template>

        <div class="relative w-full sm:h-64 h-36 overflow-hidden">
            <img src="img/background.jpg" alt="" class="w-full sm:h-auto h-64 overflow-hidden">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
            <h1 class="text-xl font-semibold leading-tight text-white">
                RM Simangat
            </h1>
            <h2 class="sm:text-xl text-sm font-semibold leading-tight text-white">
                Nikmati Hidangan Spesial Kami, Rasakan Kelezatan Disetiap Gigitannya Simangat Bertoh-Mangat.
            </h2>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <ul>
                            <p v-if="pesanan.length === 0" class="text-gray-500">Belum ada pesanan dari pelanggan.</p>
                            <li v-if="pesanan.length != 0">
                                <Orders :data="pesanan" :rute="route"/>      
                            </li>
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
        pesanan: Array,
        route: Array
    },
    components: {
        Orders,
        PrimaryButton,
        
    }
}
</script>
