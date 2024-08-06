<script setup>
import HeaderAuth from '@/Components/HeaderAuth.vue';
import Footer from '@/Components/Footer.vue';
import { useMq } from "vue3-mq";

const mq = useMq();

</script>

<template>
    <HeaderAuth 
        v-if="mq.desktop"
    />

    <main :class="mq.desktop ? 'max-w-[624px] w-full px-6 mt-10 mb-20 mx-auto' : 'mobile'">
        <slot />
    </main>

    <Footer 
        v-if="mq.desktop"
    />
</template>