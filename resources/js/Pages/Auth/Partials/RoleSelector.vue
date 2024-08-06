<script setup>
import { useMq } from "vue3-mq";

const model = defineModel({ 
    type: String,
    required: true
});

const mq = useMq();

</script>

<template>
    <div class="flex mb-10">
        <div
            @click="model = 'App\\Models\\Seeker'" 
            class="flex justify-center items-center gap-2 w-2/4 text-center rounded-l-lg cursor-pointer txt-text-buttons"
            :class="[
                model == 'App\\Models\\Seeker' ? 'bg-blue50' : 'bg-gray50', 
                mq.desktop ? 'py-4' : 'py-3'
            ]"
        >
            Я шукаю роботу 
            <div v-show="model == 'App\\Models\\Seeker'" class="icon-checked"></div>
        </div>
        <div 
            @click="model = 'App\\Models\\Saloon'" 
            class="flex justify-center items-center gap-2 w-2/4 text-center rounded-r-lg cursor-pointer txt-text-buttons"
            :class="[
                model == 'App\\Models\\Saloon' ? 'bg-blue50' : 'bg-gray50', 
                mq.desktop ? 'py-4' : 'py-3'
            ]"
        >
            Я роботодавець 
            <div v-show="model == 'App\\Models\\Saloon'" class="icon-checked"></div>
        </div>
    </div>
</template>
