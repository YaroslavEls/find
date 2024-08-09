<script setup>
import { MqResponsive } from "vue3-mq";
import { Link } from '@inertiajs/vue3';

const scrollTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <footer class="border-solid border-t-2 border-gray50">
                <div class="flex justify-between max-w-[1512px] w-full mx-auto px-6 py-8">
                    <div>
                        <Link href="/" class="w-fit"><div class="icon-logo" /></Link>
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

        <template #mobile>
            <footer class="px-4 pt-4 pb-12">
                <div class="flex justify-between items-center mb-4">
                    <Link href="/">
                        <div class="icon-logo" />
                    </Link>
                    <div @click="scrollTop" class="text-blue40 txt-buttons">Повернутися вгору</div>
                </div>
                <div class="flex items-center gap-1 mb-8 txt-secondary">
                    Зроблено в Україні!
                    <div class="icon-flag" />
                </div>
                <div class="txt-secondary">Designed & Developed by S.Wagoon Agency © 2024</div>
            </footer>
        </template>
    </MqResponsive>
</template>
