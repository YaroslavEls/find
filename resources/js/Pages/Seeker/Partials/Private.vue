<script setup>
import EmailPasswordPlaceholders from '@/Components/EmailPasswordPlaceholders.vue';
import Text from '@/Components/Inputs/Text.vue';
import { useMq } from 'vue3-mq';

const model = defineModel({
    type: Object,
    required: true 
});

const mq = useMq();

</script>

<template>
    <div :class="mq.desktop ? 'w-[576px]' : 'w-full'">
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
