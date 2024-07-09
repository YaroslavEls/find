<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';

const model = defineModel({ 
    type: Object,
    required: true 
});
const current = defineModel('current', {
    type: Number,
    required: true
});

const url = URL;

const add = () => {
    current.value = ++current.value;
};

const submit = () => {
    model.value.post(route('register.saloon'), {
        onError: () => console.log(model.value)
    });
};

</script>

<template>
    <div class="mb-10 txt-h3">Ваші локації</div>

    <div
        v-for="location in model.locations"
        :key="location"
        @click="edit"
        class="flex w-full mb-10 px-4 py-2 rounded-lg bg-gray70"
    >
        <img
            :src="url.createObjectURL(location.photos[0])"
            class="w-14 h-14 mr-4 border-solid border border-gray0 rounded-full"
        >
        <div class="flex flex-col justify-between">
            <div class="txt-h5">{{ '' + location.name }}</div>
            <div class="txt-secondary">{{ location.city + ', ' + location.address}}</div>
        </div>
    </div>

    <SubmitButton
        @click="add"
        text="Додати локацію"
        regular
        class="mb-10 border-solid border-2 border-gray40 bg-opacity-0"
    />

    <SubmitButton
        @click="submit"
        text="Зареєструвати заклад!"
        regular
    />
</template>
