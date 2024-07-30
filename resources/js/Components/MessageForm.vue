<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';

const model = defineModel({
    type: Object,
    required: true
});

</script>

<template>
    <div class="flex gap-[2.5%] h-full">
        <input 
            type="text"
            placeholder="Повідомлення"
            v-model="model.text"
            class="basis-[75%] p-4 w-full bg-background border-gray40 border-solid border-2 rounded-lg text-gray0 txt-body"
        >
        <SubmitButton 
            text="Надіслати"
            class="basis-[22.5%]"
        />
    </div>
</template>
