<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Menu" />

    <AuthenticatedLayout>
        <template #header>
            <div>
                <a href="#" class="text-2xl font-bold text-yellow-600"> Owner RasaHaka - Daftar Menu </a>
                <address class="mt-2 not-italic">Takengon, Kebayakan, Gizatama Residence.</address>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg flex justify-center">
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
    </AuthenticatedLayout>
</template>

<script>
import Orders from './Order/Orders.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AdminMenu from './Order/AdminMenu.vue';

export default {
    props: {
        Product: Array
    },
    components: {
        Orders,
        PrimaryButton,
        AdminMenu,
    }
}
</script>
