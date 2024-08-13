<script setup>
import { MqResponsive } from "vue3-mq";
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

const selected = defineModel('selected', { 
    type: [Number, null],
    required: true 
});
const modal = defineModel('modal', {
    type: [String, null],
    required: false
});

const options = (x) => {
    if (selected.value == x) {
        selected.value = null;
        return;
    }
    selected.value = x;
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
    <MqResponsive group>
        <template #desktop>
            <div class="relative flex mb-12">
                <Link 
                    :href="route('vacancies.show', { vacancy: vacancy.id })"
                    class="mr-8"
                >
                    <div
                        class="min-w-[272px] w-[424px] h-[272px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${vacancy.location.photos.split(';')[0]}')` }"
                    />
                </Link>
                
                <div class="mr-8 max-w-[728px] w-full">
                    <Tags
                        :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                        class="mb-4"
                    />
                    <div class="mb-4 txt-h3">
                        {{ vacancy.job }} - 
                        <span class="text-systemgreen">{{ vacancy.salary }}₴</span>
                    </div>
                    <div v-if="vacancy.location.gen" class="flex gap-2 items-center mb-4">
                        <div class="icon-gen" />
                        <div class="txt-h5">Маємо генератор</div>
                    </div>
                    <Link
                        :href="route('location.show', { vacancy: vacancy.id, location: vacancy.location.id })"
                        class="flex gap-2 w-fit mb-4 items-center text-gray20 txt-h5"
                    >
                        <div class="icon-location" />
                        <div>({{ vacancy.location.city }})</div>
                        <div>{{ vacancy.location.address }}</div>
                    </Link>
                    <Link
                        :href="route('saloons.show', { vacancy: vacancy.id })"
                        class="flex items-center gap-2 mb-4 w-fit"
                    >
                        <div
                            class="w-6 h-6 rounded-full border-solid border border-gray50 image"
                            :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                        />
                        <div class="text-blue30 txt-h5">{{ vacancy.saloon.name }}</div>
                    </Link>
                    <div class="mb-2 text-gray40 txt-body crop crop-2">
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
                    class="max-w-14 w-full h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
                    :class="selected == index ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-if="isSeeker"
                    v-show="selected == index" 
                    :items="menuItems()"
                    v-model="modal"
                />
            </div>
        </template>

        <template #mobile>
            <div class="relative mb-8">
                <div
                    v-if="isSeeker"
                    @click="options(index)"
                    class="absolute top-2 right-2 w-[29px] h-5 rounded icon-options bg-center bg-no-repeat"
                    :class="selected == index ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-if="isSeeker"
                    v-show="selected == index" 
                    :items="menuItems()"
                    v-model="modal"
                />

                <Link :href="route('vacancies.show', { vacancy: vacancy.id })" class="block mb-4">
                    <div
                        class="w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${vacancy.location.photos.split(';')[0]}')` }"
                    />
                </Link>

                <Tags
                    :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                    class="mb-4"
                />

                <div class="mb-4 txt-h3">
                    {{ vacancy.job }} - 
                    <span class="text-systemgreen">{{ vacancy.salary }}₴</span>
                </div>

                <div v-if="vacancy.location.gen" class="flex gap-1 items-center mb-4">
                    <div class="icon-gen" />
                    <div class="txt-h5">Маємо генератор</div>
                </div>

                <div class="flex gap-2 mb-2 items-center txt-h5">
                    <div class="icon-location" />
                    <div>({{ vacancy.location.city }})</div>
                    <div>{{ vacancy.location.address }}</div>
                </div>

                <Link
                    :href="route('saloons.show', { vacancy: vacancy.id })"
                    class="flex items-center gap-2 mb-2 w-fit"
                >
                    <div
                        class="w-6 h-6 rounded-full border-solid border border-gray50 image"
                        :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                    />
                    <div class="text-blue30 txt-h5">{{ vacancy.saloon.name }}</div>
                </Link>

                <div class="text-gray40 txt-body crop crop-2">
                    {{ vacancy.descr }}
                </div>
            </div>
        </template>
    </MqResponsive>
</template>
