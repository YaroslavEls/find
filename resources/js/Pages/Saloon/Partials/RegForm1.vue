<script setup>
import Text from '@/Components/Inputs/Text.vue';
import TextArea from '@/Components/Inputs/TextArea.vue';
import File from '@/Components/Inputs/File.vue';
import Lines from '@/Components/Inputs/Lines.vue';
import SubmitButton from '@/Components/SubmitButton.vue';

const model = defineModel({
    type: Object,
    required: true 
});
const current = defineModel('current', {
    type: Number,
    required: true
});

const submit = () => {
    model.value.socials = model.value.socials.filter(x => x !== '');
    if (model.value.socials.length == 0) {
        model.value.socials.push('');
    }

    model.value.post(route('saloon.validate'), {
        onError: () => console.log(model.value),
        onSuccess: () => current.value = ++current.value
    });
};

</script>

<template>
    <form @submit.prevent="submit">
        <Text
            type="text"
            placeholder="Gang Coffee"
            heading="Назва закладу(-дів)"
            :error="model.errors.name"
            v-model="model.name"
        />
        <TextArea
            placeholder="Ми позитивні та круті"
            heading="Опис"
            note="Розкажіть трошки про вас, вашу історію або просто щось цікаве."
            :error="model.errors.descr"
            v-model="model.descr"
        />
        <File
            identifier="logo"
            allowed=".png,.jpg,.svg"
            heading="Логотип вашого закладу"
            subheading="Максимум 1 фото"
            button="Додати фото"
            :error="model.errors.logo"
            v-model="model.logo"
        />
        <Lines
            heading="Посилання на соц мережі"
            :error="model.errors"
            v-model="model.socials"
        />
        <SubmitButton
            text="Продовжити"
            class="mt-2"
        />
    </form>
</template>
