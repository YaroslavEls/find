<script setup>
import OptionsMenu from '@/Components/OptionsMenu.vue';

const props = defineProps({
    vacancy: { 
        type: Object,
        required: true 
    },
    location: { 
        type: Object,
        required: true 
    },
    saloon: { 
        type: Object,
        required: true 
    },
    index: { 
        type: Number,
        required: true 
    }
});

const model = defineModel({ 
    type: Number,
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
    edit: route('vacancy.edit', { vacancy: props.vacancy.id }),
    delete: route('vacancy.delete', { vacancy: props.vacancy.id })
};

</script>

<template>
    <div class="relative flex mb-12">
        <img
            :src="location.photos.split(';')[0]" 
            class="w-[424px] h-[272px] mr-8 border-solid border-2 border-gray50 rounded-lg"
        >

        <div class="grow mr-8">
            <div class="mb-4 txt-h3">
                {{ vacancy.job }} - 
                <span class="text-systemgreen">{{ vacancy.salary }}₴</span>
            </div>
            <div class="flex gap-2 mb-4 itemc-center text-gray20 txt-h5">
                <div class="icon-location" />
                <div>({{ location.city }})</div>
                <div>{{ location.address }}</div>
            </div>
            <div class="flex gap-2">
                <img 
                    :src="saloon.logo" 
                    class="w-6 h-6 mb-4 rounded-full border-solid border border-gray50"
                >
                <div>{{ saloon.name }}</div>
            </div>
            <div class="text-gray40 txt-body">
                {{ vacancy.descr }}
            </div>
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
