<script setup>
import Text from '@/Components/Inputs/Text.vue';
import Range from '@/Components/Inputs/Range.vue';
import TextArea from '@/Components/Inputs/TextArea.vue';
import DropdownMulti from '@/Components/Inputs/DropdownMulti.vue';
import DropdownSingle from '@/Components/Inputs/DropdownSingle.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});

</script>

<template>
    <DropdownSingle
        heading="Локація"
        :options="$page.props.auth.user.saloon.locations.map(item => item.name)"
        :error="model.errors.location_id"
        v-model="model.location"
    />
    <DropdownSingle
        heading="Посада"
        :options="['Бариста', 'Старший Бариста']"
        :error="model.errors.job"
        v-model="model.job"
    />
    <DropdownMulti
        heading="Тип зайнятості"
        :error="model.errors.employment"
        v-model="model.employment"
    />
    <Text
        type="text"
        heading="Зарплата"
        :error="model.errors.salary"
        v-model="model.salary"
    />
    <Range
        heading="Досвід"
        subheading=" років"
        :error="model.errors.experience"
        v-model="model.experience"
    />
    <TextArea
        heading="Опис вакансії"
        :error="model.errors.descr"
        v-model="model.descr"
    />
</template>
