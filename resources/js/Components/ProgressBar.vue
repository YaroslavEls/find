<script setup>
import { useMq } from "vue3-mq";

const props = defineProps({
    heading: {
        type: String,
        required: true
    },
    steps: {
        type: String,
        required: true 
    },
    current: { 
        type: Number,
        required: true 
    }
});

const mq = useMq();

const styles = props.steps > 2 
    ? ['w-[25%]', 'w-[50%]', 'w-[75%]', 'w-[100%] rounded-r-xl'] 
    : ['w-[50%]', 'w-[100%] rounded-r-2xl'];

</script>

<template>
    <div class="mb-10">
        <div 
            class="flex justify-between items-end"
            :class="mq.desktop ? 'mb-4' : 'mb-2'"
        >
            <div class="txt-h1">{{ heading }}</div>
            <div 
                v-show="current < steps"
                class="text-gray30 txt-h5"
            >
                Крок {{ current + 1 }}/{{ steps }}
            </div>
        </div>

        <div 
            v-show="current < steps" 
            class="w-full bg-gray10 rounded-2xl"
            :class="mq.desktop ? 'h-4' : 'h-[10px]'"
        >
            <div 
                :class="styles[current]"
                class="h-full bg-blue50 rounded-l-2xl duration-1000"
            />
        </div>
    </div>
</template>
