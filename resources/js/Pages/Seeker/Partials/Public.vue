<script setup>
import DropdownSingle from '@/Components/Inputs/DropdownSingle.vue';
import Range from '@/Components/Inputs/Range.vue';
import Text from '@/Components/Inputs/Text.vue';
import DropdownMulti from '@/Components/Inputs/DropdownMulti.vue';
import TextArea from '@/Components/Inputs/TextArea.vue';
import File from '@/Components/Inputs/File.vue';
import UpdatePhoto from '@/Components/Inputs/UpdatePhoto.vue';

defineProps({
    seeker: {
        type: Object,
        required: true
    }
});

const model = defineModel({
    type: Object,
    required: true 
});

</script>

<template>
    <div class="w-[576px]">
        <DropdownSingle
            heading="Посада"
            :options="['Бариста', 'Старший Бариста']"
            :error="model.errors.job"
            v-model="model.job"
        />
        <Range
            heading="Досвід"
            subheading=" років"
            :error="model.errors.experience"
            v-model="model.experience"
        />
        <Text
            type="text"
            heading="Зарплатні очікування"
            :error="model.errors.salary"
            v-model="model.salary"
        />
        <Text
            type="text"
            heading="Місто"
            :error="model.errors.city"
            v-model="model.city"
        />
        <DropdownMulti
            heading="Тип зайнятості"
            :error="model.errors.employment"
            v-model="model.employment"
        />
        <TextArea
            heading="Про вас"
            note="Розкажіть трошки про себе та чому роботодавець має вибрати саме вас."
            :error="model.errors.info"
            v-model="model.info"
        />
        <File
            identifier="cv_edit"
            allowed=".pdf"
            heading="Ваше резюме"
            :button="seeker.cv ? seeker.cv.split('/')[1] : 'Завантажити файл'"
            :error="model.errors.cv"
            v-model="model.cv"
        />
    </div>

    <div class="w-[576px]">
        <UpdatePhoto
            identifier="profile_photo"
            allowed=".png,.jpg"
            :original="seeker.photo"
            button="Змінити фото профілю"
            :error="model.errors.photo"
            v-model="model.photo"
        />
    </div>
</template>
