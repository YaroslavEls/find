<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref, onMounted } from 'vue';
import { useMq } from "vue3-mq";

defineProps({
    heading: {
        type: String,
        required: true
    },
    subheading: {
        type: String,
        required: true
    },
    note: {
        type: String
    },
    error: {
        type: String
    }
});

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
    <InputLayout>
        <template #heading>{{ heading }}</template>
        <template #subheading>{{ (model == 6.5 ? '6+' : model) + subheading }}</template>
        
        <template #default>
            <input
                ref="bar"
                type="range"
                min="0"
                max="6.5"
                step="0.5"
                v-model="model"
                class="w-full"
                :class="mq.desktop ? 'h-14' : 'h-[52px]'"
            >

            <div 
                v-for="pos in positions" 
                :key="pos"
                :ref="pos"
                class="absolute w-[2px] h-[10px] bg-gray40 rounded-2xl z-[-1]"
                :class="mq.desktop ? 'top-[53px]' : 'top-[46px]'"
            />
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
