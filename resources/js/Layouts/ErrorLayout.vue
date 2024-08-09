<script setup>
import Footer from '@/Components/Footer.vue';
import { Link } from '@inertiajs/vue3';
import { useMq } from "vue3-mq";

const mq = useMq();

</script>

<template>
    <header class="w-fit" :class="mq.desktop ? 'px-16 py-10' : 'p-4'">
        <Link href="/"><div class="icon-logo" /></Link>
    </header>

    <main :class="mq.current" >
        <slot />
    </main>

    <Footer
        v-if="mq.desktop"
    />
</template>
