<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    email: { 
        type: String,
        required: true 
    }
});

</script>

<template>
    <div class="mb-4 text-gray40 txt-h3">Персональні:</div>
    <div class="mb-1 txt-h5">Ел. пошта</div>
    <div class="mb-12 p-4 w-full bg-background border-solid border-2 border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body">
        {{ email }}
    </div>
    <div class="mb-1 txt-h5">Пароль</div>
    <div class="mb-2 p-4 w-full bg-background border-solid border-2 border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body">
        ********
    </div>
    <Link :href="route('home')" class="block mb-10 text-blue40 text-right txt-text-buttons">
        Змінити пароль
    </Link>
</template>
