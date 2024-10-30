<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import RoleSelector from '@/Pages/Auth/Partials/RoleSelector.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    type: {
        type: String,
        required: false,
        default: 0
    }
});

const form = useForm({
    userable_type: props.type === '1' ? 'App\\Models\\Saloon' : 'App\\Models\\Seeker',
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const allow = computed(() => {
    return form.email !== '' && form.password !== '';
});

</script>

<template>
    <Head title="Вхід" />

    <AuthLayout>
        <form @submit.prevent="submit" class="w-full">
            <BackButton />

            <div class="txt-h1 mb-4">
                Увійти до 
                <span class="text-blue40">FIND</span>
            </div>

            <RoleSelector 
                v-model="form.userable_type"
            />
            <Text
                type="email"
                placeholder="example@gmail.com"
                heading="Ел. пошта"
                v-model="form.email"
            />
            <Text
                type="password"
                placeholder="********"
                heading="Пароль"
                v-model="form.password"
            />

            <Link
                :href="route('password.request')"
                class="relative top-[-24px] text-blue40 txt-text-buttons block text-right"
            >
                Забув пароль?
            </Link>

            <div
                v-if="form.errors.email"
                class="text-systemred txt-secondary"
            >
                {{ form.errors.email }}
            </div>

            <SubmitButton
                text="Увійти"
                class="mt-4"
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />

            <Link 
                :href="route('register', { type: form.userable_type === 'App\\Models\\Saloon' ? 1 : 0 })" 
                class="mt-6 text-blue40 txt-text-buttons block text-center mb-[100px]"
            >
                Я ще не маю аккаунта
            </Link>
        </form>
    </AuthLayout>
</template>
