<script setup>
import { Link } from '@inertiajs/vue3';
import { useMq } from 'vue3-mq';

defineProps({
    email: { 
        type: String,
        required: true 
    }
});

const mq = useMq();

</script>

<template>
    <div class="mb-1 txt-h5">Ел. пошта</div>
    <div 
        class="mb-8 p-4 w-full bg-background border-solid border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body"
        :class="mq.desktop ? 'border-2' : 'border'"
    >
        {{ email }}
    </div>
    <div class="mb-1 txt-h5">Пароль</div>
    <div 
        class="mb-2 p-4 w-full bg-background border-solid border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body"
        :class="mq.desktop ? 'border-2' : 'border'"
    >
        ********
    </div>
    <Link :href="route('home')" class="block mb-10 text-blue40 text-right txt-text-buttons">
        Змінити пароль
    </Link>
</template>
