<script setup>
const model = defineModel({
    type: [String, Number],
    required: true
});

const positions = [
    'left-[30px]',
    'left-[60px]',
    'left-[88px]',
    'left-[118px]',
    'left-[144px]',
    'left-[173px]',
    'left-[202px]',
    'left-[228px]',
    'left-[255px]',
    'left-[280px]',
    'left-[308px]',
    'left-[336px]',
];

</script>

<template>
    <div class="relative">
        <input
            type="range"
            min="0"
            max="6.5"
            step="0.5"
            v-model="model"
            class="h-14 w-full relative z-[2]"
        >

        <div 
            v-for="pos in positions" 
            :key="pos"
            class="absolute top-[23px] w-[2px] h-[10px] bg-gray40 rounded-2xl z-[1]"
            :class="pos"
        />
    </div>
</template>
