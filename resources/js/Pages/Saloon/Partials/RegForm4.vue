<script setup>
import FormContent from '@/Pages/Location/Partials/FormContent.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const model = defineModel({
    type: Object,
    required: true 
});
const current = defineModel('current', {
    type: Number,
    required: true
});
const toEdit = defineModel('toEdit', {
    type: [Number, null],
    required: true
});

const orig = model.value.locations[toEdit.value];
const form = useForm(orig);

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
        if (newData == orig.name) {
            modified.value.name = false;
            return;
        }
        modified.value.name = newData;
    }
);
watch (
    () => form.city,
    (newData, _) => {
        if (newData == orig.city) {
            modified.value.city = false;
            return;
        }
        modified.value.city = newData;
    }
);
watch (
    () => form.address,
    (newData, _) => {
        if (newData == orig.address) {
            modified.value.address = false;
            return;
        }
        modified.value.address = newData;
    }
);
watch (
    () => form.schedule,
    (newData, _) => {
        if (JSON.stringify(newData) == JSON.stringify(orig.schedule)) {
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
        if (newData == orig.gen) {
            modified.value.gen = false;
            return;
        }
        modified.value.gen = +newData;
    }
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
    form.post(route('location.validate'), {
        onSuccess: () => {
            model.value.locations[toEdit.value] = form.data();
            form.reset();
            current.value = 1;
        }
    });
};

</script>

<template>
    <form @submit.prevent="submit">
        <FormContent
            v-model="form"
        />
        <SubmitButton 
            text="Зберегти"
            :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
        />
    </form>
</template>
