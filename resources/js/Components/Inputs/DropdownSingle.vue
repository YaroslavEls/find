<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref } from 'vue';
import { useMq } from "vue3-mq";

defineProps({
    heading: {
        type: String,
        required: true
    },
    note: {
        type: String
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

const mq = useMq();

const show = ref(false);

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <div 
                class="flex justify-between items-center p-3 mb-1 w-full bg-background border-solid rounded-lg txt-body"
                :class="[
                    show ? 'border-blue50' : 'border-gray40',
                    mq.desktop ? 'min-h-[61.2px] border-2' : 'border'
                ]"
            >
                <div class="txt-body">{{ model }}</div>
                <div 
                    @click="show = !show" 
                    class="cursor-pointer" 
                    :class="show ? 'icon-collapse' : 'icon-expand'"
                />
            </div>
            <div 
                v-show="show" 
                class="absolute w-full overflow-y-scroll border-solid border-gray40 rounded-lg bg-background z-10"
                :class="mq.desktop ? 'max-h-[500px] border-2' : 'max-h-[300px] border'"
            >
                <div
                    v-for="opt in options"
                    :key="opt"
                    @click="model = opt" 
                    class="flex justify-between cursor-pointer"
                    :class="mq.desktop ? 'p-4' : 'px-3 py-2'"
                >
                    <div class="txt-body">{{ opt }}</div>
                    <div 
                        class="rounded-full" 
                        :class="[
                            model == opt ? 'bg-gray0 border-solid border-[6px] border-blue50' : 'bg-gray60',
                            mq.desktop ? 'w-6 h-6' : 'w-5 h-5'    
                        ]"
                    />
                </div>
            </div>
        </template>

        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
