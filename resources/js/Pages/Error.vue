<script setup>
import { MqResponsive } from "vue3-mq";
import ErrorLayout from '@/Layouts/ErrorLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    code: {
        type: Number,
        required: true
    }
});

const back = () => {
    window.history.back();
};

const descriptions = {
    404: 'Сторінку не знайдено'
};

</script>

<template>
    <Head :title="code" />

    <ErrorLayout>
        <MqResponsive group>
            <template #desktop>
                <div class="flex justify-center items-center gap-10">
                    <div class="text-center font-bold text-[240px]">
                        {{ code }}
                    </div>

                    <div class="text-center text-gray20 txt-h2">
                        Упс... Виникла помилка
                        <br>
                        <div v-if="descriptions[code]">{{ descriptions[code] }}</div>
                    </div>
                </div>
                
                <div class="flex justify-center gap-6 w-full">
                    <div
                        @click="back"
                        class="w-[424px] py-[18px] border-solid border-2 border-gray40 rounded-lg text-center txt-buttons cursor-pointer"
                    >
                        Повернутися назад
                    </div>
                    <Link
                        :href="route('home')"
                        class="w-[424px] py-5 bg-blue50 rounded-lg text-center txt-buttons"
                    >
                        Повернутися на домашню сторінку
                    </Link>
                </div>
            </template>

            <template #mobile>
                <div class="text-center font-bold text-[104px]">
                    {{ code }}
                </div>

                <div class="mb-12 text-center text-gray20 txt-h2">
                    Упс... Виникла помилка
                    <br>
                    <div v-if="descriptions[code]">{{ descriptions[code] }}</div>
                </div>

                <div
                    @click="back"
                    class="mb-6 py-3 border-solid border border-gray40 rounded-lg text-center txt-buttons cursor-pointer"
                >
                    Повернутися назад
                </div>
                <Link
                    :href="route('home')"
                    class="block py-3 bg-blue50 rounded-lg text-center txt-buttons"
                >
                    Повернутися на домашню сторінку
                </Link>
            </template>
        </MqResponsive>
    </ErrorLayout>
</template>
