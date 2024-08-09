<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <header class="flex justify-between items-center px-16 py-10">
        <Link href="/"><div class="icon-logo" /></Link>

        <div class="flex items-center gap-12">
            <div class="font-semibold text-[20px] text-gray50 cursor-not-allowed">
                Увійти
            </div>
            <div class="font-semibold text-[20px] text-gray50 cursor-not-allowed">
                Зареєструватися
            </div>
        </div>
    </header>
</template>
