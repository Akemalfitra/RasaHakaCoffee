<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Pesanan" />

    <AuthenticatedLayout>

        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                       <FormEditProduct :data="product"/>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Orders from './Order/Orders.vue';
import FormEditProduct from './Order/FormEditProduct.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';

export default {
    props: {
        product : Array
    },
    components: {
        Orders,
        PrimaryButton,
        Link,
        FormEditProduct
    },
      methods: {
        goBack() {
            window.history.back(); // Kembali ke halaman sebelumnya
        }
    }
}
</script>
