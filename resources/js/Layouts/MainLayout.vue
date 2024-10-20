<script setup>
import HeaderMain from '@/Components/HeaderMain.vue';
import Footer from '@/Components/Footer.vue';
import { Head } from '@inertiajs/vue3';
import { useMq } from "vue3-mq";

const mq = useMq();

</script>

<template>
    <Head>
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
    </Head>

    <HeaderMain />

    <main :class="[mq.current, $page.component === 'Home' ? 'home' : '']" >
        <slot />
    </main>

    <Footer
        v-if="mq.desktop || $page.component === 'Home'"
    />
</template>
