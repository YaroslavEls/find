<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';
import { useMq } from "vue3-mq";

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

const mq = useMq();

const url = URL;

const add = () => {
    current.value = ++current.value;
};

const edit = (i) => {
    toEdit.value = i;
    current.value = 3;
};

const remove = (i) => {
    model.value.locations.splice(i, 1);
};

const submit = () => {
    model.value.post(route('register.saloon'), {
        onError: () => console.log(model.value)
    });
};

</script>

<template>
    <div 
        class="txt-h3"
        :class="mq.desktop ? 'mb-10' : 'mb-4'"
    >
        Ваші локації
    </div>

    <div
        v-for="(location, index) in model.locations"
        :key="index"
        class="flex justify-between items-center w-full px-4 py-2 rounded-lg bg-gray70"
        :class="mq.desktop ? 'mb-10' : 'mb-6'"
    >
        <div class="flex">
            <img
                :src="url.createObjectURL(location.photos[0])"
                class="border-solid border border-gray0 rounded-full"
                :class="mq.desktop ? 'w-14 h-14 mr-4' : 'w-12 h-12 mr-2'"
            >
            <div class="flex flex-col justify-around">
                <div class="txt-h5">{{ '' + location.name }}</div>
                <div class="text-gray30 txt-secondary">{{ location.city + ', ' + location.address}}</div>
            </div>
        </div>
        <div class="flex gap-2">
            <div @click="edit(index)" class="icon-edit cursor-pointer" />
            <div @click="remove(index)" class="icon-delete cursor-pointer" />
        </div>
    </div>

    <div 
        v-if="model.errors.locations"
        class="text-systemred txt-secondary"
        :class="mq.desktop ? 'mb-10' : 'mb-6'"
    >
        {{ model.errors.locations }}
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
