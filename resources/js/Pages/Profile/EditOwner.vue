    <script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutOwner.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { defineComponent } from 'vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Link } from "@inertiajs/vue3";

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

defineComponent({
    PrimaryButton,
    Link
})

</script>

<template>
    <Head title="Profile Admin" />

    <AuthenticatedLayout>   
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Profile
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >
                    <DeleteUserForm class="max-w-xl" />
                </div>

                <div
                    class="bg-white p-4 shadow sm:rounded-lg sm:p-8"
                >

                     <h2 class="text-lg font-medium text-gray-900">
                        Tambahkan akun admin
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 py-3">
                        Tambahkan akun admin untuk mempermudah pengelolaan menu dan pesanan pelanggan.
                    </p>
                    <Link
                    :href="route('admin.register')"
                    >
                    <PrimaryButton>Tambahkan akun admin</PrimaryButton>
                     </Link>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
