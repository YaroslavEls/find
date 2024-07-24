<script setup>
import OptionsMenu from '@/Components/OptionsMenu.vue';
import Tags from '@/Components/Tags.vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    seeker: { 
        type: Object,
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
    if (usePage().props.auth.user.saves.includes(props.seeker.id)) {
        return { unsave: route('unsave.seeker', { seeker: props.seeker }) }
    }

    return { save: route('save.seeker', { seeker: props.seeker }) };
};

</script>

<template>
    <div class="relative flex mb-12">
        <Link :href="route('seekers.show', { seeker: seeker.id })" class="mr-8">
            <img
                :src="seeker.photo" 
                class="w-[272px] h-[272px] border-solid border-2 border-gray50 rounded-lg"
            >
        </Link>

        <div class="max-w-[880px] grow mr-8">
            <Tags
                :tags="{ date: seeker.updated_at, exp: seeker.experience, empl: seeker.employment }"
                class="mb-4"
            />
            <div class="mb-4 txt-h3">
                {{ seeker.job }} - 
                <span class="text-systemgreen">{{ seeker.salary }}₴</span>
            </div>
            <div class="flex gap-2 mb-4 itemc-center text-gray20 txt-h5">
                <div class="icon-location" />
                <div>{{ seeker.city }}</div>
            </div>
            <Link
                :href="route('seekers.show', { seeker: seeker.id })"
                class="flex gap-2 mb-4 itemc-center w-fit text-blue30 txt-h5"
            >
                <div class="icon-person" />
                <div>{{ seeker.name }}</div>
            </Link>
            <div class="mb-2 text-gray40 txt-body cropped">
                {{ seeker.info }}
            </div>
            <Link
                :href="route('seekers.show', { seeker: seeker.id })"
                class="block w-fit my-0 mr-0 ml-auto text-right text-blue40 txt-text-buttons"
            >
                Більше
            </Link>
        </div>

        <div
            @click="options(seeker.id)"
            class="w-14 h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
            :class="model == seeker.id ? 'bg-gray70' : 'bg-gray50'"
        />

        <OptionsMenu
            v-show="model == seeker.id" 
            :items="menuItems()"
        />
    </div>
</template>
