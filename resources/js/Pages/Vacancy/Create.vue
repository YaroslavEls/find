<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Vacancy/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    locations: {
        type: Array,
        required: true
    }
});

const mq = useMq();

const form = useForm({
    location: props.locations[0].name,
    location_id: props.locations[0].id,
    job: 'Бариста',
    employment: ['Повна', 'Неповна', 'Підміни'],
    salary: null,
    experience: 1,
    descr: null 
});

const submit = () => {
    const location = props.locations.find(item => item.name == form.location);
    form.location_id = location ? location.id : null;

    form.post(route('vacancy.store'));
};

const allow = computed(() => {
    const data = form.data();

    if (data.employment.length === 0) return false;

    const values = Object.values(data);
    for (let i = 0; i < values.length; i++) {
        if (values[i] === null || values[i] === '') return false;
    }
    return true;
});

</script>

<template>
    <Head title="Створення Вакансії" />

    <MainLayout>
        <form 
            @submit.prevent="submit" 
            :class="mq.desktop ? 'w-[576px] mt-6 mb-32 mx-auto' : 'w-full'"
        >
            <BackButton />

            <div class="mb-10 txt-h1">Створення вакансії</div>

            <FormContent
                v-model="form"
                :locations="locations"
            />

            <SubmitButton
                text="Створити"
                :class="allow ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
        </form>
    </MainLayout>
</template>
