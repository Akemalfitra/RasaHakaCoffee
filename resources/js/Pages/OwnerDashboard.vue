<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Pesanan pelanggan" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <a href="#" class="text-2xl font-bold text-yellow-600"> Owner RasaHaka </a>
                <address class="mt-2 not-italic">Takengon, Kebayakan, Gizatama Residence.</address>
            </div>
        </template>

        <div class="relative w-full sm:h-64 h-36 overflow-hidden">
            <img src="img/rasahaka-down.jpg" alt="" class="w-full sm:h-auto h-64 overflow-hidden">  
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
            <h1 class="text-xl font-semibold leading-tight text-white">
                RasaHaka
            </h1>
            <h2 class="sm:text-xl text-sm font-semibold leading-tight text-white">
                Rasakan Kopi dengan varian cita rasa yang berbeda
            </h2>
            </div>
        </div>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div 
                    class="p-6 text-gray-900"
                    :class="pesanan.length !== 0 ? 'mb-24' : ''"
                    >
                        <ul>
                            <p v-if="pesanan.length === 0" class="text-gray-500drop">Belum ada pesanan dari pelanggan.</p>
                            <li v-if="pesanan.length != 0">
                                <Orders :data="pesanan"/>      
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
        pesanan: Array
    },
    components: {
        Orders,
        PrimaryButton,
        
    }
}
</script>
