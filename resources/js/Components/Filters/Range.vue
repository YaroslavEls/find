<script setup>
import { useMq } from "vue3-mq";
import { ref, onMounted } from 'vue';

const model = defineModel({
    type: [String, Number],
    required: true
});

const mq = useMq();

const bar = ref(null);

const positions = [];
for (let i = 0; i < 12; i++) {
    positions.push(ref(null));
}

onMounted(() => {
    const width = window.getComputedStyle(bar.value).width;
    const num = +width.slice(0, -2) / 13;

    for (let i = 1; i <= 12; i++) {
        positions[i-1].value[0].style.left = `${i * num}px`;
    }
});

</script>

<template>
    <div class="relative" :class="mq.desktop ? 'h-14' : 'h-[52px]'">
        <input
            ref="bar"
            type="range"
            min="0"
            max="6.5"
            step="0.5"
            v-model="model"
            class="w-full relative z-[2]"
            :class="mq.desktop ? 'h-14' : 'h-[52px]'"
        >

        <div 
            v-for="pos in positions" 
            :key="pos"
            :ref="pos"
            class="absolute w-[2px] h-[10px] bg-gray40 rounded-2xl z-[1]"
            :class="[pos, mq.desktop ? 'top-[23px]' : 'top-[21px]']"
        />
    </div>
</template>
