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
                Daftar Menu
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                             <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg flex">
                                <div class="p-6 text-gray-900">
                                    <ul class="grid sm:grid-cols-2 gap-6 grid-cols-1 md:grid-cols-3">
                                    <li v-for="item in Product">
                                        <AdminMenu :data="item" />
                                    </li>
                                    </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Orders from './Order/Orders.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AdminMenu from './Order/AdminMenu.vue';

export default {
    props: {
        Product: Array,
        route
    },
    components: {
        Orders,
        PrimaryButton,
        AdminMenu,
    }
}
</script>
