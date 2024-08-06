<script setup>
import HeaderMain from '@/Components/HeaderMain.vue';
import Footer from '@/Components/Footer.vue';
import { useMq } from "vue3-mq";

const mq = useMq();

</script>

<template>
    <HeaderMain />

    <main :class="mq.current" >
        <slot />
    </main>

    <Footer
        v-if="mq.desktop || $page.component === 'Home'"
    />
</template>
