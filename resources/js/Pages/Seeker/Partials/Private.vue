<script setup>
import EmailPasswordPlaceholders from '@/Components/EmailPasswordPlaceholders.vue';
import Text from '@/Components/Inputs/Text.vue';

const model = defineModel({
    type: Object,
    required: true 
});

</script>

<template>
    <div class="w-[576px]">
        <Text
            type="text"
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

        <EmailPasswordPlaceholders
            :email="$page.props.auth.user.email"
        />
    </div>
</template>
