<script setup>
const model = defineModel({ 
    type: String,
    required: true
});

</script>

<template>
    <div class="flex">
        <div
            @click="model = 'App\\Models\\Seeker'" 
            class="flex justify-center items-center gap-2 w-2/4 py-4 mb-10 text-center rounded-l-lg cursor-pointer txt-text-buttons"
            :class="model == 'App\\Models\\Seeker' ? 'bg-blue50' : 'bg-gray50'"
        >
            Я шукаю роботу 
            <div v-show="model == 'App\\Models\\Seeker'" class="icon-checked"></div>
        </div>
        <div 
            @click="model = 'App\\Models\\Saloon'" 
            class="flex justify-center items-center gap-2 w-2/4 py-4 mb-10 text-center rounded-r-lg cursor-pointer txt-text-buttons"
            :class="model == 'App\\Models\\Saloon' ? 'bg-blue50' : 'bg-gray50'"
        >
            Я роботодавець 
            <div v-show="model == 'App\\Models\\Saloon'" class="icon-checked"></div>
        </div>
    </div>
</template>
