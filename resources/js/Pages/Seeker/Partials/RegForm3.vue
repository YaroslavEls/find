<script setup>
import City from '@/Components/Inputs/City.vue';
import DropdownMulti from '@/Components/Inputs/DropdownMulti.vue';

const model = defineModel({ 
    type: Object,
    required: true
});

</script>

<template>
    <Suspense>
        <City 
            heading="Місто"
            :error="model.errors.city"
            v-model="model.city"
        />
    </Suspense>
    <DropdownMulti
        heading="Тип зайнятості"
        :error="model.errors.employment"
        v-model="model.employment"
    />
</template>
