<script setup>
import DropdownSingle from '@/Components/Inputs/DropdownSingle.vue';
import Range from '@/Components/Inputs/Range.vue';
import Text from '@/Components/Inputs/Text.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});

</script>

<template>
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
        placeholder="20000"
        heading="Зарплатні очікування"
        :error="model.errors.salary"
        v-model="model.salary"
    />
</template>
