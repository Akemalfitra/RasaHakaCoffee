<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Orders from './Order/Orders.vue';
import { defineComponent } from 'vue';

defineProps({
    pesanan: Object,
})

defineComponent({
    Orders
})

</script>

<template>
    <Head title="Pesanan anda" />

    <AuthenticatedLayout>
        <template #header>

            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                <p>List pesanan</p>
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <ul>
                            <p
                            v-if="pesanan.length === 0"
                            class="text-gray-500"
                            >anda belum memesan apapun.
                            </p>
                            <li v-for="item in pesanan" :key="pesanan.id">
                                <Orders :data="item"/>      
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
