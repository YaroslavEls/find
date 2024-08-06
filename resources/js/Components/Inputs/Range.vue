<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
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

const positions = [
    'left-[46px]',
    'left-[90px]',
    'left-[134px]',
    'left-[178px]',
    'left-[222px]',
    'left-[266px]',
    'left-[308px]',
    'left-[352px]',
    'left-[396px]',
    'left-[440px]',
    'left-[484px]',
    'left-[528px]',
];

const positionsMobile = [
    'left-[29px]',
    'left-[57px]',
    'left-[83px]',
    'left-[111px]',
    'left-[137px]',
    'left-[165px]',
    'left-[193px]',
    'left-[220px]',
    'left-[246px]',
    'left-[273px]',
    'left-[302px]',
    'left-[330px]',
]

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>
        <template #subheading>{{ (model == 6.5 ? '6+' : model) + subheading }}</template>
        
        <template #default>
            <input
                type="range"
                min="0"
                max="6.5"
                step="0.5"
                v-model="model"
                class="w-full"
                :class="mq.desktop ? 'h-14' : 'h-[52px]'"
            >

            <div 
                v-for="pos in (mq.desktop ? positions : positionsMobile)" 
                :key="pos"
                class="absolute w-[2px] h-[10px] bg-gray40 rounded-2xl z-[-1]"
                :class="[pos, mq.desktop ? 'top-[53px]' : 'top-[46px]']"
            />
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
