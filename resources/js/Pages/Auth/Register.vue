<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import RoleSelector from '@/Pages/Auth/Partials/RoleSelector.vue';
import AgreeCheckbox from '@/Pages/Auth/Partials/AgreeCheckbox.vue';
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
    email: null,
    password: null,
    agree: false
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password')
    });
};

const allow = computed(() => {
    return form.email !== '' 
        && form.password !== ''
        && form.agree === true;
});

</script>

<template>
    <Head title="Реєстрація" />

    <AuthLayout>
        <form @submit.prevent="submit" class="w-full">
            <BackButton />
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
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />

            <Link
                :href="route('login', { type: form.userable_type === 'App\\Models\\Saloon' ? 1 : 0 })" 
                class="mt-6 text-blue40 txt-text-buttons block text-center mb-[100px]"
            >
                Я вже маю акаунт!
            </Link>
        </form>
    </AuthLayout>
</template>
