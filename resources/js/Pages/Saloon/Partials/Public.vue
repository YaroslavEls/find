<script setup>
import EmailPasswordPlaceholders from '@/Components/EmailPasswordPlaceholders.vue';
import DeleteAccountButton from '@/Components/DeleteAccountButton.vue';
import Text from '@/Components/Inputs/Text.vue';
import TextArea from '@/Components/Inputs/TextArea.vue';
import Lines from '@/Components/Inputs/Lines.vue';
import UpdatePhoto from '@/Components/Inputs/UpdatePhoto.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

// import VueCropper from 'vue-cropperjs';
// import 'cropperjs/dist/cropper.css';

const props = defineProps({
    saloon: {
        type: Object,
        required: true
    }
});

const form = useForm({
    name: props.saloon.name,
    descr: props.saloon.descr,
    logo: null,
    socials: props.saloon.socials.split(';'),
    _method: 'patch',
});

const modified = ref({
    name: false,
    descr: false,
    logo: false,
    socials: false
});

watch (
    () => form.name,
    (newData, _) => {
        if (newData == props.saloon.name) {
            modified.value.name = false;
            return;
        }
        modified.value.name = newData;
    }
);
watch (
    () => form.descr,
    (newData, _) => {
        if (newData == props.saloon.descr.replaceAll("\r\n", "\n").replaceAll("\r", "\n")) {
            modified.value.descr = false;
            return;
        }
        modified.value.descr = newData;
    }
);
watch (
    () => form.logo,
    (newData, _) => {
        modified.value.logo = newData;
    }
);
watch (
    () => form.socials,
    (newData, _) => {
        const oldData = props.saloon.socials.split(';');
        if (JSON.stringify(newData) == JSON.stringify(oldData)) {
            modified.value.socials = false;
            return;
        }
        modified.value.socials = newData;
    },
    { deep: true }
);

const refresh = () => {
    Object.keys(modified.value).forEach(key => {
        modified.value[key] = false;
    });
};

const submit = () => {
    form.socials = form.socials.filter(x => x !== '');
    if (form.socials.length == 0) {
        form.socials.push('');
    }

    form.post(route('saloon.update'), {
        onSuccess: () => refresh(),
        onError: () => console.log(form)
    });
};

const selectedFile = props.saloon.logo;

</script>

<template>
    <div class="flex justify-between">
        <form @submit.prevent="submit" class="w-[576px]">
            <div class="mb-4 text-gray40 txt-h3">Загальні:</div>
            <Text
                type="text"
                heading="Назва закладу або мережі"
                :error="form.errors.name"
                v-model="form.name"
            />
            <TextArea
                heading="Про вас"
                :error="form.errors.descr"
                v-model="form.descr"
            />
            <EmailPasswordPlaceholders
                :email="$page.props.auth.user.email"
            />
            <SubmitButton
                text="Зберегти зміни"
                :class="Object.values(modified).some(value => value !== false) ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
            />
            <DeleteAccountButton />
        </form>

        <div class="w-[728px]">
            <div class="mb-4 text-gray40 txt-h3">Логотип:</div>
            <UpdatePhoto
                identifier="saloon_logo"
                allowed=".png,.jpg,.svg"
                :original="saloon.logo"
                button="Змінити фото"
                :error="form.errors.logo"
                v-model="form.logo"
            />
            <div class="mb-4 text-gray40 txt-h3">Соціальні мережі:</div>
            <Lines
                :error="form.errors"
                v-model="form.socials"
            />
        </div>
    </div>

    <!-- <VueCropper 
        v-show="selectedFile" 
        ref="cropper" 
        :src="selectedFile" 
        :aspectRatio="16/9" 
        :initialAspectRatio="16/9" 
        :autoCropArea="1"
        :zoomable="false"
    /> -->

</template>
