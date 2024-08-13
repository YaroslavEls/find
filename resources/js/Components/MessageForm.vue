<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';
import { useMq } from 'vue3-mq';

const form = defineModel('form', {
    type: Object,
    required: true
});
const area = defineModel('area', {
    type: [Object, null],
    required: true
});

const mq = useMq();

const resize = () => {
    const posY = window.scrollY;
    area.value.style.height = 'auto';
    area.value.style.height = (area.value.scrollHeight + 4) + 'px';
    window.scrollTo(0, posY);
};

</script>

<template>
    <div class="flex" :class="mq.desktop ? 'gap-[2.5%]' : 'gap-2'">
        <textarea
            rows="1"
            placeholder="Повідомлення"
            ref="area"
            @input="resize"
            v-model="form.text"
            class="px-4 w-full bg-background border-gray40 border-solid rounded-lg txt-body"
            :class="mq.desktop ? 'basis-[75%] py-4 border-2' : 'py-[14px] border'"
        ></textarea>

        <SubmitButton
            v-if="mq.desktop"
            text="Надіслати"
            class="basis-[22.5%] h-fit"
        />

        <button
            v-if="mq.mobile"
            class="max-w-12 w-full h-12 rounded-lg bg-center bg-no-repeat bg-blue50 icon-send" 
        />
    </div>
</template>
