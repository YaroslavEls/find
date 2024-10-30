<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

defineProps({
    status: {
        type: String,
        required: false
    }
});

const form = useForm({
    email: ''
});

const submit = () => {
    form.post(route('password.email'), {
        onSuccess: () => form.reset(),
    });
};

const allow = computed(() => {
    return form.email !== '';
});

</script>

<template>
    <Head title="Відновлення паролю" />

    <AuthLayout>
        <form @submit.prevent="submit" class="w-full">
            <BackButton />
            <div class="mb-4 txt-h1">Відновлення паролю</div>
            <div class="mb-10 text-gray30 txt-body">Для відновлення пароля, введіть пошту на яку був зареєстрований ваш акаунт</div>
            <Text
                type="email"
                placeholder="example@gmail.com"
                heading="Ел. пошта"
                note="На цю пошту буде надіслано лист для відновлення пароля"
                :error="form.errors.email"
                v-model="form.email"
            />
            <SubmitButton
                text="Надіслати"
                class="mt-4 mb-8"
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
            <div v-if="status" class="txt-body">{{ status }}</div>
        </form>
    </AuthLayout>
</template>
