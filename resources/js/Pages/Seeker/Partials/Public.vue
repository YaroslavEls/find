<script setup>
import { MqResponsive } from "vue3-mq";
import Radio from '@/Components/Inputs/Radio.vue';
import DropdownSingle from '@/Components/Inputs/DropdownSingle.vue';
import Range from '@/Components/Inputs/Range.vue';
import Text from '@/Components/Inputs/Text.vue';
import City from '@/Components/Inputs/City.vue';
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
    <MqResponsive group>
        <template #desktop>
            <div class="flex justify-between gap-6">
                <div class="w-[576px]">
                    <Radio
                        heading="Ви зараз шукаєте роботу?"
                        v-model="model.active"
                    />
                    <DropdownSingle
                        heading="Посада"
                        note="Посада яку ви шукаєте"
                        :options="['Бариста', 'Старший Бариста']"
                        :error="model.errors.job"
                        v-model="model.job"
                    />
                    <Range
                        heading="Досвід"
                        subheading=" років"
                        note="Ваш досвід на цій посаді"
                        :error="model.errors.experience"
                        v-model="model.experience"
                    />
                    <Text
                        type="text"
                        heading="Зарплатні очікування"
                        note="Сумма на яку ви розраховуєте враховуючи ваш тип зайнятості"
                        :error="model.errors.salary"
                        v-model="model.salary"
                    />
                    <Suspense>
                        <City 
                            heading="Місто"
                            note="Ваше місце проживання"
                            :error="model.errors.city"
                            v-model="model.city"
                        />
                    </Suspense>
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
            </div>
        </template>

        <template #mobile>
            <Radio
                heading="Ви зараз шукаєте роботу?"
                v-model="model.active"
            />
            <UpdatePhoto
                identifier="profile_photo"
                allowed=".png,.jpg"
                :original="seeker.photo"
                button="Змінити фото профілю"
                :error="model.errors.photo"
                v-model="model.photo"
            />
            <DropdownSingle
                heading="Посада"
                note="Посада яку ви шукаєте"
                :options="['Бариста', 'Старший Бариста']"
                :error="model.errors.job"
                v-model="model.job"
            />
            <Range
                heading="Досвід"
                subheading=" років"
                note="Ваш досвід на цій посаді"
                :error="model.errors.experience"
                v-model="model.experience"
            />
            <Text
                type="text"
                heading="Зарплатні очікування"
                note="Сумма на яку ви розраховуєте враховуючи ваш тип зайнятості"
                :error="model.errors.salary"
                v-model="model.salary"
            />
            <Suspense>
                <City 
                    heading="Місто"
                    note="Ваше місце проживання"
                    :error="model.errors.city"
                    v-model="model.city"
                />
            </Suspense>
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
        </template>
    </MqResponsive>
</template>
