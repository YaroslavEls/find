<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Footer from '@/Components/Footer.vue';
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <header class="flex justify-between items-center px-16 py-10">
        <Link href="/">
            <ApplicationLogo />
        </Link>

        <div class="flex items-center gap-12">
            <div class="font-semibold text-[20px] text-gray50 cursor-not-allowed">
                Увійти
            </div>
            <div class="font-semibold text-[20px] text-gray50 cursor-not-allowed">
                Зареєструватися
            </div>
        </div>
    </header>

    <main class="max-w-[624px] w-full px-6 mt-6 mb-20 mx-auto">
        <slot />
    </main>

    <Footer />
</template>