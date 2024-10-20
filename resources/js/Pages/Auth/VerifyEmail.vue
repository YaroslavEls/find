<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: [String, null],
        required: true
    }
});

</script>

<template>
    <Head title="Підтвердження пошти" />

    <AuthLayout>
        <div class="mt-20 w-full">
            <BackButton />
            <div class="txt-h1 mb-4">Підтвердження пошти</div>
            <div class="mb-4 text-gray30 txt-body">На пошту вказану під час реєстрації був надісланий лист для підтвердження та продовження реєстрації</div>
            <Link 
                :href="route('verification.send')"
                method="post"
                as="button"
                class="mb-4 text-blue40 txt-body"
            >
                Надіслати лист повторно
            </Link>
            <div 
                v-if="status === 'verification-link-sent'" 
                class="txt-body"
            >
                Лист успішно надіслано.
            </div>
        </div>
    </AuthLayout>
</template>
