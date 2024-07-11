<script setup>
import Text from '@/Components/Inputs/Text.vue';
import Schedule from '@/Components/Inputs/Schedule.vue';
import File from '@/Components/Inputs/File.vue';
import Photos from '@/Components/Inputs/Photos.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});

</script>

<template>
    <Text
        type="text"
        placeholder="Тт 109"
        heading="Назва локації"
        :error="model.errors.name"
        v-model="model.name"
    />
    <Text
        type="text"
        placeholder="Київ"
        heading="Місто"
        :error="model.errors.city"
        v-model="model.city"
    />
    <Text
        type="text"
        placeholder="Свободи 32"
        heading="Адреса"
        :error="model.errors.address"
        v-model="model.address"
    />
    <Schedule
        type="text"
        heading="Графік роботи"
        :error="model.errors.schedule"
        v-model="model.schedule"
    />
    <Photos
        identifier="loc_photo"
        heading="Фото вашого закладу"
        subheading="Максимум 12 фото"
        button="Додати фото"
        :error="model.errors.photos"
        v-model:photos="model.photos"
        v-model:oldPhotos="model.oldPhotos"
    />
    <File
        identifier="loc_video"
        allowed=".mpeg,.mp4,.avi"
        heading="Відео огляд закладу"
        subheading="Максимум 1 відео"
        button="Додати відео"
        :error="model.errors.video"
        v-model="model.video"
    />
</template>
