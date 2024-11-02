<script setup>
import Text from '@/Components/Inputs/Text.vue';
import City from '@/Components/Inputs/City.vue';
import Schedule from '@/Components/Inputs/Schedule.vue';
import Checkbox from '@/Components/Inputs/Checkbox.vue';
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
    <Suspense>
        <City 
            heading="Місто"
            :error="model.errors.city"
            v-model="model.city"
        />
    </Suspense>
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
        subheading="Максимум 12 фото, до 10МБ кожне"
        button="Додати фото"
        :error="model.errors"
        v-model:photos="model.photos"
        v-model:oldPhotos="model.oldPhotos"
    />
    <File
        identifier="loc_video"
        allowed=".mpeg,.mp4,.avi,.mov"
        heading="Відео огляд закладу"
        subheading="Максимум 1 відео, до 100МБ"
        button="Додати відео"
        deletable
        :error="model.errors.video"
        v-model="model.video"
    />
    <Checkbox
        text="На даній локації присутні генератори в якості резервного джерела електропостачання"
        :error="model.errors.gen"
        v-model="model.gen"
    />
</template>
