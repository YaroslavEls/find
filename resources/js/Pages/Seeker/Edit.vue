<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProfileNav from '@/Components/ProfileNav.vue';
import DeleteAccountButton from '@/Components/DeleteAccountButton.vue';
import Public from '@/Pages/Seeker/Partials/Public.vue';
import Private from '@/Pages/Seeker/Partials/Private.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    seeker: {
        type: Object,
        required: true
    }
});

const mq = useMq();

const tabs = {Public, Private};
const names = {
    'Public': 'Профіль',
    'Private': 'Особисті дані'
};
const current = ref('Public');

const form = useForm({
    name: props.seeker.name,
    birthday: props.seeker.birthday,
    job: props.seeker.job,
    experience: props.seeker.experience,
    salary: props.seeker.salary,
    city: props.seeker.city,
    employment: props.seeker.employment.split(';'),
    info: props.seeker.info,
    cv: null,
    photo: null,
    active: props.seeker.active,
    _method: 'patch',
});

const modified = ref({
    name: false,
    birthday: false,
    job: false,
    experience: false,
    salary: false,
    city: false,
    employment: false,
    info: false,
    cv: false,
    photo: false
});

watch (
    () => form.name,
    (newData, _) => {
        if (newData == props.seeker.name) {
            modified.value.name = false;
            return;
        }
        modified.value.name = newData;
    }
);
watch (
    () => form.birthday,
    (newData, _) => {
        if (newData == props.seeker.birthday) {
            modified.value.birthday = false;
            return;
        }
        modified.value.birthday = newData;
    }
);
watch (
    () => form.job,
    (newData, _) => {
        if (newData == props.seeker.job) {
            modified.value.job = false;
            return;
        }
        modified.value.job = newData;
    }
);
watch (
    () => form.experience,
    (newData, _) => {
        if (newData == props.seeker.experience) {
            modified.value.experience = false;
            return;
        }
        modified.value.experience = newData;
    }
);
watch (
    () => form.salary,
    (newData, _) => {
        if (newData == props.seeker.salary) {
            modified.value.salary = false;
            return;
        }
        modified.value.salary = newData;
    }
);
watch (
    () => form.city,
    (newData, _) => {
        if (newData == props.seeker.city) {
            modified.value.city = false;
            return;
        }
        modified.value.city = newData;
    }
);
watch (
    () => form.employment,
    (newData, _) => {
        const oldData = props.seeker.employment.split(';');
        if (JSON.stringify(newData) == JSON.stringify(oldData)) {
            modified.value.employment = false;
            return;
        }
        modified.value.employment = newData;
    },
    { deep: true }
);
watch (
    () => form.info,
    (newData, _) => {
        if (newData == props.seeker.info.replaceAll("\r\n", "\n").replaceAll("\r", "\n")) {
            modified.value.info = false;
            return;
        }
        modified.value.info = newData;
    }
);
watch (
    () => form.cv,
    (newData, _) => {
        modified.value.cv = newData;
    }
);
watch (
    () => form.photo,
    (newData, _) => {
        modified.value.photo = newData;
    }
);
watch (
    () => form.active,
    (newData, _) => {
        if (newData == props.seeker.active) {
            modified.value.name = false;
            return;
        }
        modified.value.name = +newData;
    }
);

const refresh = () => {
    Object.keys(modified.value).forEach(key => {
        modified.value[key] = false;
    });
};

const submit = () => {
    form.post(route('seeker.update'), {
        onSuccess: () => refresh(),
        onError: () => console.log(form)
    });
};

</script>

<template>
    <Head title="Профіль" />

    <MainLayout>
        <ProfileNav
            :names="names"
            v-model="current"
            v-model:form="form"
        />

        <form @submit.prevent="submit">
            <component
                :is="tabs[current]"
                :seeker="seeker"
                v-model="form"
            />

            <SubmitButton
                text="Зберегти зміни"
                class="max-w-[576px]"
                :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />

            <DeleteAccountButton
                v-show="current == 'Private'"
                class="max-w-[576px]"
            />
        </form>
    </MainLayout>
</template>
