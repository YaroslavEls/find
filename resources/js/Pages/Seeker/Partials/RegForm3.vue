<script setup>
import Text from '@/Components/Inputs/Text.vue';
import DropdownMulti from '@/Components/Inputs/DropdownMulti.vue';

const model = defineModel({ 
    type: Object,
    required: true
});

</script>

<template>
    <Text
        type="text"
        placeholder="Київ"
        heading="Місто"
        :error="model.errors.city"
        v-model="model.city"
    />
    <DropdownMulti
        heading="Тип зайнятості"
        :error="model.errors.employment"
        v-model="model.employment"
    />
</template>
