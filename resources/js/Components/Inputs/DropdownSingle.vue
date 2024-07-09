<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref } from 'vue';

defineProps({
    heading: {
        type: String,
        required: true
    },
    options: {
        type: Array,
        required: true
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: [String, null],
    required: true
});

const show = ref(false);

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <div 
                class="flex justify-between items-center p-3 mb-1 w-full min-h-[61.2px] bg-background border-solid border-2 rounded-lg text-gray0 txt-body"
                :class="error ? 'border-systemred' : 'border-gray40'"
            >
                <div class="txt-body">{{ model }}</div>
                <div 
                    @click="show = !show" 
                    class="cursor-pointer" 
                    :class="show ? 'icon-collapse' : 'icon-expand'"
                />
            </div>
            <div v-show="show" class="absolute w-full border-solid border-2 border-gray40 rounded-lg bg-background z-10">
                <div
                    v-for="opt in options"
                    :key="opt"
                    @click="model = opt" 
                    class="flex justify-between p-4 cursor-pointer"
                >
                    <div class="txt-body">{{ opt }}</div>
                    <div 
                        class="w-6 h-6 rounded-full" 
                        :class="model == opt ? 'bg-gray0 border-solid border-[6px] border-blue50' : 'bg-gray50'"
                    />
                </div>
            </div>
        </template>

        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
