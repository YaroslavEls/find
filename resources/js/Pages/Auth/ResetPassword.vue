<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    email: {
        type: String,
        required: true
    },
    token: {
        type: String,
        required: true
    }
});

const form = useForm({
    email: props.email,
    token: props.token,
    password: ''
});

const submit = () => {
    form.post(route('password.store'), {
        onError: () => console.log(form),
        onFinish: () => form.reset(),
    });
};

const allow = computed(() => {
    return form.password !== '';
});

</script>

<template>
    <Head title="Відновлення паролю" />

    <AuthLayout>
        <form @submit.prevent="submit" class="w-full mt-20">
            <div class="mb-4 txt-h1">Відновлення паролю</div>
            <div class="mb-10 text-gray30 txt-body">Створіть новий пароль для свого акаунту</div>
            <Text
                type="password"
                placeholder="********"
                heading="Новий пароль"
                :error="form.errors.password"
                v-model="form.password"
            />
            <SubmitButton
                text="Підтвердити"
                class="mt-4 mb-8"
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
            <div v-if="form.errors.email" class="text-systemred txt-body">{{ form.errors.email }}</div>
        </form>
    </AuthLayout>
</template>
