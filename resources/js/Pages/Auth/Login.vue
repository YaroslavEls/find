<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import RoleSelector from '@/Pages/Auth/Partials/RoleSelector.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    userable_type: 'App\\Models\\Seeker',
    email: '',
    password: ''
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Login" />

        <form @submit.prevent="submit" class="w-[576px] mt-[75px] mx-auto">
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
                :error="form.errors.email"
                v-model="form.email"
            />
            <Text
                type="password"
                placeholder="********"
                heading="Пароль"
                :error="form.errors.password"
                v-model="form.password"
            />

            <Link
                :href="route('home')"
                class="relative top-[-24px] text-blue40 txt-text-buttons block text-right"
            >
                Забув пароль?
            </Link>

            <SubmitButton
                text="Увійти"
                class="mt-4"
            />

            <Link 
                :href="route('register')" 
                class="mt-6 text-blue40 txt-text-buttons block text-center mb-[100px]"
            >
                Я ще не маю аккаунта
            </Link>
        </form>
    </MainLayout>
</template>
