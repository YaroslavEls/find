<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useMq } from 'vue3-mq';

const mq = useMq();

const form = useForm({
    name: null,
    city: 'Київ',
    address: null,
    schedule: [null, null, null, null, null, null, null],
    gen: false,
    photos: [],
    video: null 
});

const submit = () => {
    form.post(route('location.store'));
};

const allow = computed(() => {
    const data = form.data();
    delete data['video'];

    if (data.photos.length === 0) return false;

    const values = Object.values(data);
    for (let i = 0; i < values.length; i++) {
        if (values[i] === null || values[i] === '') return false;
    }
    return true;
})

</script>

<template>
    <Head title="Створення Локації" />

    <MainLayout>
        <form 
            @submit.prevent="submit" 
            class="w-full"
            :class="mq.desktop ? 'max-w-[624px] px-6 mx-auto' : ''"
        >
            <BackButton />

            <div class="mb-10 txt-h1">Додавання локації</div>

            <FormContent 
                v-model="form"
            />

            <SubmitButton
                text="Створити"
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
        </form>
    </MainLayout>
</template>
