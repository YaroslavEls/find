<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Vacancy/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    vacancy: {
        type: Object,
        required: true
    },
    locations: {
        type: Array,
        required: true
    }
});

const mq = useMq();

const form = useForm({
    location: props.locations.find(loc => loc.id === props.vacancy.location_id).name,
    location_id: props.vacancy.location_id,
    job: props.vacancy.job,
    employment: props.vacancy.employment.split(';'),
    salary: props.vacancy.salary,
    experience: props.vacancy.experience,
    descr: props.vacancy.descr,
    _method: 'patch'
});

const modified = ref({
    location: false,
    job: false,
    employment: false,
    salary: false,
    experience: false,
    descr: false
});

watch (
    () => form.location,
    (newData, _) => {
        if (newData == props.locations.find(loc => loc.id === props.vacancy.location_id).name) {
            modified.value.location = false;
            return;
        }
        modified.value.location = newData;
    }
);
watch (
    () => form.job,
    (newData, _) => {
        if (newData == props.vacancy.job) {
            modified.value.job = false;
            return;
        }
        modified.value.job = newData;
    }
);
watch (
    () => form.employment,
    (newData, _) => {
        const oldData = props.vacancy.employment.split(';');
        if (JSON.stringify(newData) == JSON.stringify(oldData)) {
            modified.value.employment = false;
            return;
        }
        modified.value.employment = newData;
    },
    { deep: true }
);
watch (
    () => form.salary,
    (newData, _) => {
        if (newData == props.vacancy.salary) {
            modified.value.salary = false;
            return;
        }
        modified.value.salary = newData;
    }
);
watch (
    () => form.experience,
    (newData, _) => {
        if (newData == props.vacancy.experience) {
            modified.value.experience = false;
            return;
        }
        modified.value.experience = newData;
    }
);
watch (
    () => form.descr,
    (newData, _) => {
        if (newData == props.vacancy.descr.replaceAll("\r\n", "\n").replaceAll("\r", "\n")) {
            modified.value.descr = false;
            return;
        }
        modified.value.descr = newData;
    }
);

const submit = () => {
    const location = props.locations.find(item => item.name == form.location);
    form.location_id = location ? location.id : null;

    form.post(route('vacancy.update', { vacancy: props.vacancy.id }), {
        onError: () => console.log(form)
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Add a Location" />

        <form 
            @submit.prevent="submit" 
            :class="mq.desktop ? 'w-[576px] mt-6 mb-32 mx-auto' : 'w-full'"
        >
            <BackButton />

            <div class="mb-10 txt-h1">Редагування вакансії</div>

            <FormContent
                v-model="form"
                :locations="locations"
            />

            <SubmitButton
                text="Зберегти зміни"
                :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
        </form>
    </MainLayout>
</template>
