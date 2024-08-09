<script setup>
defineProps({
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
        <div class="flex">
            <input
                @keydown.enter.prevent
                type="checkbox" 
                v-model="model"
                class="w-6 h-6 border-none mr-2 rounded bg-gray50"
            >
            <div class="txt-secondary">
                Реєструючись, я даю згоду на обробку 
                <span class="text-blue40">персональних данних</span> 
                та погоджуюсь з 
                <span class="text-blue40">політикою конфіденційності</span>.
            </div>
        </div>
        <div v-show="error" class="mt-1 h-6 text-systemred txt-secondary">
            {{ error }}
        </div>
    </div>
</template>
