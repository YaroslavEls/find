<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MessageForm from '@/Components/MessageForm.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    user: {
        type: Object,
        required: true
    }
});

const form = useForm({
    text: ''
});

const textarea = ref(null);

const submit = () => {
    form.post(route('chat.store', { user: props.user.id }));
};

</script>

<template>
    <Head title="Новий чат" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="mb-10 text-gray40 text-center txt-h5">Тут ще немає повідомлень</div>

        <div class="max-w-[1184px] w-full mx-auto">
            <form @submit.prevent="submit">
                <MessageForm
                    v-model:form="form"
                    v-model:area="textarea"
                />
            </form>
        </div>
    </MainLayout>
</template>
