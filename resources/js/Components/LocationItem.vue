<script setup>
import OptionsMenu from '@/Components/OptionsMenu.vue';

const props = defineProps({
    location: { 
        type: Object,
        required: true 
    },
    index: { 
        type: Number,
        required: true 
    }
});

const model = defineModel({ 
    type: [Number, null],
    required: true 
});

const options = (x) => {
    if (model.value == x) {
        model.value = null;
        return;
    }
    model.value = x;
};

const menuItems = {
    edit: route('location.edit', { location: props.location.id }),
    delete: route('location.delete', { location: props.location.id })
};

</script>

<template>
    <div class="relative flex mb-12">
        <img 
            :src="location.photos.split(';')[0]"
            class="w-[424px] h-[272px] mr-8 border-solid border-2 border-gray50 rounded-lg"
        >

        <div class="grow mr-8">
            <div class="mb-6 txt-h2">{{ location.name }}</div>
            <div class="mb-2 text-gray40 txt-body">Адреса:</div>
            <div class="mb-6 txt-h4">{{ location.city }} , {{ location.address }}</div>
            <div class="mb-2 text-gray40 txt-body">Графік роботи закладу:</div>
            <div class="txt-h4">{{ location.schedule }}</div>
        </div>

        <div
            @click="options(index)"
            class="w-14 h-10 rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
            :class="model == index ? 'bg-gray70' : 'bg-gray50'"
        />

        <OptionsMenu
            v-show="model == index" 
            :items="menuItems"
        />
    </div>
</template>
