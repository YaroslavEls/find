<script setup>
import TextArea from '@/Components/Inputs/TextArea.vue';
import File from '@/Components/Inputs/File.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});

</script>

<template>
    <TextArea
        placeholder="Я молодець"
        heading="Розкажіть про себе"
        note="Розкажіть трошки про себе та чому роботодавець має обрати саме вас."
        :error="model.errors.info"
        v-model="model.info"
    />
    <File
        identifier="cv"
        allowed=".pdf"
        heading="Ваше резюме"
        subheading="Максимум 1 файл"
        button="Завантажити файл"
        note="Це не обовязково, але за бажанням, ви можете додати окремий файл до свого профілю."
        :error="model.errors.cv"
        v-model="model.cv"
    />
</template>
