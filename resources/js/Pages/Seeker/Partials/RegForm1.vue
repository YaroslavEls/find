<script setup>
import Text from '@/Components/Inputs/Text.vue';
import File from '@/Components/Inputs/File.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});

</script>

<template>
    <Text
        type="text"
        placeholder="Джон Доу"
        heading="Ім'я Прізвище"
        :error="model.errors.name"
        v-model="model.name"
    />
    <Text
        type="date"
        heading="Дата народження"
        :error="model.errors.birthday"
        v-model="model.birthday"
    />
    <File
        identifier="photo"
        allowed=".png,.jpg"
        heading="Ваше фото"
        subheading="Максимум 1 фото, до 10МБ"
        button="Додати фото"
        :error="model.errors.photo"
        v-model="model.photo"
    />
</template>
