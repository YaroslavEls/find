<script setup>
defineProps({
    heading: {
        type: String,
        required: true
    }
});

const model = defineModel({
    type: Boolean,
    required: true
});

</script>

<template>
    <div class="mb-10">
        <div class="txt-h5 mb-4">Ви зараз шукаєте роботу?</div>
        <div class="flex justify-between flex-wrap gap-y-6">
            <div @click="model = true" class="flex gap-4 cursor-pointer">
                <div 
                    class="w-6 h-6 rounded-full" 
                    :class="model ? 'bg-gray0 border-solid border-[6px] border-blue50' : 'bg-gray60'"
                />
                <div class="txt-h4">Я шукаю роботу</div>
            </div>
            <div @click="model = false" class="flex gap-4 cursor-pointer">
                <div 
                    class="w-6 h-6 rounded-full" 
                    :class="!model ? 'bg-gray0 border-solid border-[6px] border-blue50' : 'bg-gray60'"
                />
                <div class="txt-h4">Я не шукаю роботу</div>
            </div>
        </div>
    </div>
</template>
