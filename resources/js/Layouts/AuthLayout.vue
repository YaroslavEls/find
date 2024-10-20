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

    <main :class="mq.desktop ? 'desktop-auth' : 'mobile'">
        <slot />
    </main>

    <Footer 
        v-if="mq.desktop"
    />
</template>