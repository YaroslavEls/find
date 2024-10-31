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
        type: [String, Number],
        required: true 
    },
    isSeeker: {
        type: Boolean,
        required: true
    }
});

const selected = defineModel('selected', { 
    type: [String, Number, null],
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
        const opts = {
            edit: route('vacancy.edit', { vacancy: props.vacancy.id }),
        };

        if (props.vacancy.active) {
            opts['deactivate'] =
                route('vacancy.deactivate', { vacancy: props.vacancy.id })
        } else {
            opts['activate'] = 
                route('vacancy.activate', { vacancy: props.vacancy.id })
        }

        opts['delete'] = route('vacancy.delete', { vacancy: props.vacancy.id });

        return opts;
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
                    class="relative mr-8"
                >
                    <div
                        class="min-w-[272px] w-[424px] h-[272px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${vacancy.location.photos.split(';')[0]}')` }"
                    />
                    <div 
                        v-if="!vacancy.active"
                        class="absolute bg-[#A9B2C2]/60 inset-0 w-full h-[272px] rounded-lg"
                    >
                        <div class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] px-4 py-2 rounded bg-gray70 txt-h5 whitespace-nowrap">
                            Вакансія неактивна
                        </div>
                    </div>
                </Link>
                
                <div class="mr-8 max-w-[728px] w-full" :class="vacancy.active ? '' : 'text-gray40'">
                    <Tags
                        :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                        :disabled="vacancy.active ? false : true"
                        class="mb-4"
                    />
                    <div class="mb-4 txt-h3">
                        {{ vacancy.job }} - 
                        <span :class="vacancy.active ? 'text-systemgreen' : 'text-gray40'">
                            {{ (+vacancy.salary).toLocaleString('de-DE') }}₴
                        </span>
                    </div>
                    <div v-if="vacancy.location.gen" class="flex gap-2 items-center mb-4">
                        <div class="icon-gen" :class="vacancy.active ? '' : 'gray'" />
                        <div class="txt-h5">Маємо генератор</div>
                    </div>
                    <Link
                        :href="route('location.show', { vacancy: vacancy.id, location: vacancy.location.id })"
                        class="flex gap-2 w-fit mb-4 items-center txt-h5"
                        :class="vacancy.active ? 'text-gray20' : 'text-gray40'"
                    >
                        <div class="icon-location" :class="vacancy.active ? '' : 'gray'" />
                        <div>({{ vacancy.location.city }})</div>
                        <div>{{ vacancy.location.address }}</div>
                    </Link>
                    <Link
                        :href="route('saloons.show', { vacancy: vacancy.id })"
                        class="flex items-center gap-2 mb-4 w-fit"
                    >
                        <div
                            class="relative w-6 h-6 rounded-full border-solid border border-gray50 image"
                            :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                        >
                            <div 
                                v-if="!vacancy.active"
                                class="absolute bg-[#A9B2C2]/60 inset-0 rounded-full"
                            />
                        </div>
                        <div class="txt-h5" :class="vacancy.active ? 'text-blue30' : 'text-gray40'">
                            {{ vacancy.saloon.name }}
                        </div>
                    </Link>
                    <div class="mb-2 text-gray40 txt-body crop crop-2">
                        {{ vacancy.descr }}
                    </div>
                    <Link
                        :href="route('vacancies.show', { vacancy: vacancy.id })"
                        class="block w-fit my-0 mr-0 ml-auto text-right txt-text-buttons"
                        :class="vacancy.active ? 'text-blue40' : 'text-gray40'"
                    >
                        Більше
                    </Link>
                </div>

                <div
                    v-if="isSeeker"
                    @click="options(index)"
                    class="max-w-14 w-full h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat bg-gray60 cursor-pointer hover:bg-gray70 duration-300"
                    :class="selected == index ? 'close' : ''"
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
            <div class="relative mb-8" :class="vacancy.active ? '' : 'text-gray40'">
                <div
                    v-if="isSeeker"
                    @click="options(index)"
                    class="absolute top-2 right-2 w-[29px] h-5 rounded icon-options bg-center bg-no-repeat bg-gray60 z-10"
                    :class="selected == index ? 'close' : ''"
                />

                <OptionsMenu
                    v-if="isSeeker"
                    v-show="selected == index" 
                    :items="menuItems()"
                    v-model="modal"
                />

                <Link :href="route('vacancies.show', { vacancy: vacancy.id })" class="relative block mb-4">
                    <div
                        class="w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${vacancy.location.photos.split(';')[0]}')` }"
                    />
                    <div 
                        v-if="!vacancy.active"
                        class="absolute bg-[#A9B2C2]/60 inset-0 w-full h-[202px] rounded-lg"
                    >
                        <div class="absolute top-1/2 left-1/2 translate-x-[-50%] translate-y-[-50%] px-4 py-2 rounded bg-gray70 text-gray0 txt-h5 whitespace-nowrap">
                            Вакансія неактивна
                        </div>
                    </div>
                </Link>

                <Tags
                    :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                    :disabled="vacancy.active ? false : true"
                    class="mb-4"
                />

                <div class="mb-4 txt-h3">
                    {{ vacancy.job }} - 
                    <span :class="vacancy.active ? 'text-systemgreen' : 'text-gray40'">
                        {{ (+vacancy.salary).toLocaleString('de-DE') }}₴
                    </span>
                </div>

                <div v-if="vacancy.location.gen" class="flex gap-1 items-center mb-4">
                    <div class="icon-gen" :class="vacancy.active ? '' : 'gray'" />
                    <div class="txt-h5">Маємо генератор</div>
                </div>

                <div 
                    class="flex flex-wrap gap-x-2 mb-2 items-center txt-h5" 
                    :class="vacancy.active ? 'text-gray30' : 'text-gray40'"
                >
                    <div class="icon-location" :class="vacancy.active ? '' : 'gray'" />
                    <div>({{ vacancy.location.city }})</div>
                    <div>{{ vacancy.location.address }}</div>
                </div>

                <Link
                    :href="route('saloons.show', { vacancy: vacancy.id })"
                    class="flex items-center gap-2 mb-2 w-fit"
                >
                    <div
                        class="relative w-6 h-6 rounded-full border-solid border border-gray50 image"
                        :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                    >
                        <div 
                            v-if="!vacancy.active"
                            class="absolute bg-[#A9B2C2]/60 inset-0 rounded-full"
                        />
                    </div>
                    <div class="txt-h5" :class="vacancy.active ? 'text-blue30' : 'text-gray40'">
                        {{ vacancy.saloon.name }}
                    </div>
                </Link>

                <div class="text-gray40 txt-body crop crop-2">
                    {{ vacancy.descr }}
                </div>
            </div>
        </template>
    </MqResponsive>
</template>
