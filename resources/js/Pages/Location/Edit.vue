<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    location: {
        type: Object,
        required: true
    }
});

const mq = useMq();

const form = useForm({
    name: props.location.name,
    city: props.location.city,
    address: props.location.address,
    schedule: props.location.schedule.split(';'),
    gen: props.location.gen,
    oldPhotos: props.location.photos.split(';'),
    photos: [],
    video: props.location.video,
    videoDeleted: false,
    _method: 'patch'
});

const modified = ref({
    name: false,
    cite: false,
    address: false,
    schedule: false,
    gen: false,
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
        const oldData = props.location.schedule.split(';');
        if (JSON.stringify(newData) == JSON.stringify(oldData)) {
            modified.value.schedule = false;
            return;
        }
        modified.value.schedule = newData;
    },
    { deep: true }
);
watch (
    () => form.gen,
    (newData, _) => {
        if (newData == props.location.gen) {
            modified.value.gen = false;
            return;
        }
        modified.value.gen = +newData;
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
    let oldVideo;
    if (typeof form.video === 'string') {
        oldVideo = form.video;
        form.video = null;
    } else if (form.video === null && props.location.video !== null) {
        form.videoDeleted = true;
    }

    form.post(route('location.update', { location: props.location.id }), {
        onError: () => form.video = oldVideo ? oldVideo : form.video
    });
};

</script>

<template>
    <Head title="Редагування Локації" />

    <MainLayout>
        <form 
            @submit.prevent="submit" 
            class="w-full"
            :class="mq.desktop ? 'max-w-[624px] px-6 mx-auto' : ''"
        >
            <BackButton />

            <div class="mb-10 txt-h1">Редагування локації</div>

            <FormContent 
                v-model="form"
            />

            <SubmitButton
                text="Зберегти зміни"
                :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
        </form>
    </MainLayout>
</template>
