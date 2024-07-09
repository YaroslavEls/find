<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import RoleSelector from '@/Pages/Auth/Partials/RoleSelector.vue';
import AgreeCheckbox from '@/Pages/Auth/Partials/AgreeCheckbox.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    userable_type: 'App\\Models\\Seeker',
    email: null,
    password: null,
    agree: false
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password')
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Register" />

        <form @submit.prevent="submit" class="w-[576px] mt-[75px] mx-auto">
            <div class="txt-h1 mb-4">Реєстрація</div>
            
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
            <AgreeCheckbox
                v-model="form.agree"
                :error="form.errors.agree"
            />
            <SubmitButton
                text="Продовжити"
            />

            <Link 
                :href="route('login')" 
                class="mt-6 text-blue40 txt-text-buttons block text-center mb-[100px]"
            >
                Я вже маю акаунт!
            </Link>
        </form>
    </MainLayout>
</template>
