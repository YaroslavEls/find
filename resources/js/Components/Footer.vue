<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';

const scrollTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

</script>

<template>
    <footer class="border-solid border-t-2 border-gray50">
        <div class="flex justify-between max-w-[1512px] w-full mx-auto px-6 py-8">
            <div>
                <Link href="/" class="w-fit">
                    <ApplicationLogo />
                </Link>
                <div class="flex items-center gap-2 mt-6">
                    <div class="txt-body">Зроблено в Україні!</div>
                    <div class="icon-flag" />
                </div>
            </div>
            <div class="flex flex-col justify-around items-end">
                <div
                    @click="scrollTop"
                    class="text-blue40 txt-buttons cursor-pointer"
                >
                    Повернутися вгору!
                </div>
                <div class="txt-body">Designed & Developed by S.Wagoon Agency © 2024</div>
            </div>
        </div>
    </footer>
</template>