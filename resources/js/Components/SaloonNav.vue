<script setup>
import { useMq } from "vue3-mq";

defineProps({
    names: {
        type: Object,
        required: true
    }
});

const model = defineModel({ 
    type: String,
    required: true 
});

const mq = useMq();

const move = (name) => {
    model.value = name;
};

</script>

<template>
    <div 
        class="flex items-center gap-2"
        :class="mq.desktop ? 'mt-10 mb-14' : 'mt-6 mb-8'"
    >
        <div
            v-for="(value, key) in names"
            :key="key"
            @click="move(key)"
            class="rounded cursor-pointer txt-body"
            :class="[
                model == key ? 'bg-blue50' : 'bg-gray50',
                mq.desktop ? 'px-6 py-2' : 'px-3 py-1'
            ]"
        >
            {{ value }}
        </div>
    </div>
</template>
