<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';

const form = defineModel('form', {
    type: Object,
    required: true
});
const area = defineModel('area', {
    type: [Object, null],
    required: true
});

const resize = () => {
    area.value.style.height = 'auto';
    area.value.style.height = (area.value.scrollHeight + 4) + 'px';
};

</script>

<template>
    <div class="flex gap-[2.5%]">
        <textarea
            rows="1"
            placeholder="Повідомлення"
            ref="area"
            @input="resize"
            v-model="form.text"
            class="basis-[75%] p-4 w-full bg-background border-gray40 border-solid border-2 rounded-lg text-gray0 txt-body"
        ></textarea>

        <SubmitButton 
            text="Надіслати"
            class="basis-[22.5%] h-fit"
        />
    </div>
</template>
