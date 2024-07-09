<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const props = defineProps({
    location: {
        type: Object,
        required: true
    }
});

const form = useForm({
    name: props.location.name,
    city: props.location.city,
    address: props.location.address,
    schedule: props.location.schedule,
    oldPhotos: props.location.photos.split(';'),
    photos: [],
    video: props.location.video,
    _method: 'patch'
});

const modified = ref({
    name: false,
    cite: false,
    address: false,
    schedule: false,
    oldPhotos: false,
    photos: false,
    video: false
});

watch (
    () => form.name,
    (newData, _) => {
        if (newData == props.location.name) {
            modified.value.name = false;
            return;
        }
        modified.value.name = newData;
    }
);
watch (
    () => form.city,
    (newData, _) => {
        if (newData == props.location.city) {
            modified.value.city = false;
            return;
        }
        modified.value.city = newData;
    }
);
watch (
    () => form.address,
    (newData, _) => {
        if (newData == props.location.address) {
            modified.value.address = false;
            return;
        }
        modified.value.address = newData;
    }
);
watch (
    () => form.schedule,
    (newData, _) => {
        if (newData == props.location.schedule) {
            modified.value.schedule = false;
            return;
        }
        modified.value.schedule = newData;
    }
);
watch (
    () => form.oldPhotos,
    (newData, _) => {
        const oldData = props.location.photos.split(';');
        if (JSON.stringify(newData) == JSON.stringify(oldData)) {
            modified.value.oldPhotos = false;
            return;
        }
        modified.value.oldPhotos = newData;
    },
    { deep: true }
);
watch (
    () => form.photos,
    (newData, _) => {
        if (JSON.stringify(newData) == JSON.stringify([])) {
            modified.value.photos = false;
            return;
        }
        modified.value.photos = newData;
    },
    { deep: true }
);
watch (
    () => form.video,
    (newData, _) => {
        modified.value.video = newData;
    }
);

const submit = () => {
    if (typeof form.video === 'string') {
        form.video = null;
    }

    form.post(route('location.update', { location: props.location.id }), {
        onError: () => {
            console.log(form);
        }
    });
};

</script>

<template>
    <MainLayout>
        <Head title="Add a Location" />

        <form @submit.prevent="submit" class="w-[576px] mt-6 mb-32 mx-auto">
            <BackButton />

            <div class="mb-10 txt-h1">Редагування локації</div>

            <FormContent 
                v-model="form"
            />

            <SubmitButton
                text="Створити"
                :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
        </form>
    </MainLayout>
</template>
