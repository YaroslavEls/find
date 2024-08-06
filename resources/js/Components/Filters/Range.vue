<script setup>
import { useMq } from "vue3-mq";

const model = defineModel({
    type: [String, Number],
    required: true
});

const mq = useMq();

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

const positionsMobile = [
    'left-[29px]',
    'left-[53px]',
    'left-[77px]',
    'left-[101px]',
    'left-[125px]',
    'left-[149px]',
    'left-[174px]',
    'left-[198px]',
    'left-[226px]',
    'left-[250px]',
    'left-[274px]',
    'left-[298px]',
];

</script>

<template>
    <div class="relative" :class="mq.desktop ? 'h-14' : 'h-[52px]'">
        <input
            type="range"
            min="0"
            max="6.5"
            step="0.5"
            v-model="model"
            class="w-full relative z-[2]"
            :class="mq.desktop ? 'h-14' : 'h-[52px]'"
        >

        <div 
            v-for="pos in (mq.desktop ? positions : positionsMobile)" 
            :key="pos"
            class="absolute w-[2px] h-[10px] bg-gray40 rounded-2xl z-[1]"
            :class="[pos, mq.desktop ? 'top-[23px]' : 'top-[21px]']"
        />
    </div>
</template>
