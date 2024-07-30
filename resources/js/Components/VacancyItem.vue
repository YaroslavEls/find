<script setup>
import OptionsMenu from '@/Components/OptionsMenu.vue';
import Tags from '@/Components/Tags.vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    vacancy: { 
        type: Object,
        required: true 
    },
    index: { 
        type: Number,
        required: true 
    },
    isSeeker: {
        type: Boolean,
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

const menuItems = () => {
    if (usePage().url.startsWith('/profile')) {
        return {
            edit: route('vacancy.edit', { vacancy: props.vacancy.id }),
            delete: route('vacancy.delete', { vacancy: props.vacancy.id })
        };
    } 

    if (usePage().props.auth.user.saves.includes(props.vacancy.id)) {
        return { unsave: route('unsave.vacancy', { vacancy: props.vacancy }) }
    }

    return { save: route('save.vacancy', { vacancy: props.vacancy }) };
}

</script>

<template>
    <div class="relative flex mb-12">
        <Link 
            :href="route('vacancies.show', { vacancy: vacancy.id })"
            class="mr-8"
        >
            <img
                :src="'/' + vacancy.location.photos.split(';')[0]" 
                class="w-[424px] h-[272px] border-solid border-2 border-gray50 rounded-lg"
            >
        </Link>
        
        <div class="grow mr-8 max-w-[728px]">
            <Tags
                :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                class="mb-4"
            />
            <div class="mb-4 txt-h3">
                {{ vacancy.job }} - 
                <span class="text-systemgreen">{{ vacancy.salary }}₴</span>
            </div>
            <Link
                :href="route('location.show', { vacancy: vacancy.id, location: vacancy.location.id })"
                class="flex gap-2 w-fit mb-4 itemc-center text-gray20 txt-h5"
            >
                <div class="icon-location" />
                <div>({{ vacancy.location.city }})</div>
                <div>{{ vacancy.location.address }}</div>
            </Link>
            <Link
                :href="route('saloons.show', { vacancy: vacancy.id })"
                class="flex items-center gap-2 mb-4 w-fit"
            >
                <img 
                    :src="'/' + vacancy.saloon.logo" 
                    class="w-6 h-6 rounded-full border-solid border border-gray50"
                >
                <div class="text-blue30 txt-h5">{{ vacancy.saloon.name }}</div>
            </Link>
            <div class="mb-2 text-gray40 txt-body cropped-2">
                {{ vacancy.descr }}
            </div>
            <Link
                :href="route('vacancies.show', { vacancy: vacancy.id })"
                class="block w-fit my-0 mr-0 ml-auto text-right text-blue40 txt-text-buttons"
            >
                Більше
            </Link>
        </div>

        <div
            v-if="isSeeker"
            @click="options(index)"
            class="w-14 h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
            :class="model == index ? 'bg-gray70' : 'bg-gray50'"
        />

        <OptionsMenu
            v-if="isSeeker"
            v-show="model == index" 
            :items="menuItems()"
        />
    </div>
</template>
