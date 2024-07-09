<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';

defineProps({
    heading: {
        type: String,
        required: true
    },
    subheading: {
        type: String,
        required: true
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: [String, Number],
    required: true
});

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
                class="h-14"
            >

            <div 
                v-for="pos in positions" 
                :key="pos"
                class="absolute top-[53px] w-[2px] h-[10px] bg-gray40 rounded-2xl z-[-1]"
                :class="pos"
            />
        </template>

        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
