<script setup>
defineProps({
    text: {
        type: String,
        required: true
    },
    error: { 
        type: String
    }
});

const model = defineModel({ 
    type: Boolean,
    required: true
});

</script>

<template>
    <div class="mb-10">
        <div class="flex gap-2">
            <input 
                type="checkbox" 
                v-model="model"
                class="w-6 h-6 border-none rounded bg-gray50"
            >
            <div class="txt-body">{{ text }}</div>
        </div>
        <div v-show="error" class="mt-1 h-6 text-systemred txt-secondary">
            {{ error }}
        </div>
    </div>
</template>
