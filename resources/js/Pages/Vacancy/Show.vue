<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Tags from '@/Components/Tags.vue';
import Schedule from '@/Components/Schedule.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { router, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    vacancy: {
        type: Object,
        required: true
    }
});

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.vacancy.created_at);
const formattedDate = formatter.format(date);

const isSeeker = usePage().props.auth.user.userable_type === 'App\\Models\\Seeker';

const saveData = {
    route: route('save.vacancy', { vacancy: props.vacancy }), 
    method: 'post', 
    label: 'Додати до обраного' 
};
if (usePage().props.auth.user.saves.includes(props.vacancy.id)) {
    saveData.route = route('unsave.vacancy', { vacancy: props.vacancy });
    saveData.method = 'delete';
    saveData.label = 'Видалити з обраного';
}

const save = () => {
    router.visit(saveData.route, {
        method: saveData.method,
        preserveScroll: true
    });
};

</script>

<template>
    <MainLayout>
        
        <Breadcrumbs
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="flex justify-between">
            <div class="basis-[49%]">
                <Tags
                    :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                    class="mb-10"
                />

                <div class="mb-10 txt-h1">
                    {{ vacancy.job }} - 
                    <span class="text-systemgreen txt-h3">{{ vacancy.salary }}₴</span>
                </div>

                <div class="flex gap-4 mb-8">
                    <div class="basis-6/12">
                        <div class="mb-2 text-gray40 txt-body">Кав’ярня (Мережа):</div>
                        <Link
                            :href="route('saloons.show', { vacancy: vacancy.id })"
                            class="flex items-center gap-2 w-fit"
                        >
                            <img 
                                :src="'/' + vacancy.saloon.logo" 
                                class="w-6 h-6 rounded-full border-solid border border-gray50"
                            >
                            <div class="text-blue30 txt-h4">{{ vacancy.saloon.name }}</div>
                        </Link>
                    </div>
                    <div class="basis-6/12">
                        <div class="mb-2 text-gray40 txt-body">Локація:</div>
                        <Link
                            :href="route('location.show', { vacancy: vacancy.id, location: vacancy.location.id })"
                            class="txt-h4"
                        >
                            {{ vacancy.location.city }}, {{ vacancy.location.address }}
                        </Link>
                    </div>
                </div>

                <Link
                    :href="route('saloons.show', { vacancy: vacancy.id, sec: 'reviews' })"
                    class="block w-fit mb-10"
                >
                    <div class="mb-2 text-gray40 txt-body">Відгуки та рейтинг:</div>
                    <div class="flex items-center gap-2 txt-h4">
                        <div>Відгуки</div>
                        <div>-</div>
                        <div class="flex gap-1">
                            <div
                                v-for="x in 5"
                                :key="x"
                                class="icon-star-small"
                                :class="vacancy.score < x ? 'gray' : ''"
                            />
                        </div>
                    </div>
                </Link>

                <div class="flex gap-4 mb-8">
                    <div class="basis-6/12">
                        <div class="mb-2 text-gray40 txt-body">Графік роботи закладу:</div>
                        <Schedule
                            :schedule="vacancy.location.schedule"
                        />
                    </div>
                    <div class="basis-6/12">
                        <div class="mb-2 text-gray40 txt-body">Наявність світла:</div>
                        <div class="txt-h4">{{ vacancy.location.city, vacancy.location.address }}</div>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="mb-4 text-gray40 txt-h3">Опис вакансії:</div>
                    <div class="whitespace-pre-wrap txt-body">{{ vacancy.descr }}</div>
                </div>

                <div class="flex items-center gap-1 mb-4 text-gray40 txt-body">
                    <div class="icon-date gray" />
                    Опубліковано - {{ formattedDate }}
                </div>

                <Link :href="route('chat.create', { user: vacancy.saloon.user.id })">
                    <SubmitButton
                        v-if="isSeeker"
                        text="Відгукнутися на вакансію"
                        regular
                    />
                </Link>
            </div>

            <div class="basis-[728px]">
                <div
                    v-if="isSeeker"
                    @click="save"
                    class="flex gap-2 px-6 py-2 mb-6 h-fit w-fit my-0 mr-0 ml-auto bg-blue50 rounded txt-body cursor-pointer"
                >
                    {{ saveData.label }}
                    <div class="icon-fav" />
                </div>
                
                <Carousel :autoplay="5000" :transition="750" :wrap-around="true">
                    <Slide 
                        v-for="(photo, index) in vacancy.location.photos.split(';')" 
                        :key="index"
                        class="relative cursor-grab"
                    >
                        <img 
                            :src="'/' + photo"
                            class="w-full h-[448px] border-solid border-gray50 border-2 rounded-xl"
                        >
                        <div class="absolute right-4 bottom-2 text-gray90 txt-h5">{{ index + 1 }}/{{ vacancy.location.photos.split(';').length }}</div>
                    </Slide>
                </Carousel>

                <div class="mt-10">
                    <div class="mb-4 text-gray40 txt-h3">Соціальні мережі:</div>
                    <div
                        v-for="(item, index) in vacancy.saloon.socials.split(';')"
                        :key="index"
                        class="mb-6 txt-body"
                    >
                        {{ item }}
                    </div>
                </div>
                
            </div>
        </div>
    </MainLayout>
</template>

<style>
section.carousel {
    text-align: unset;
    padding: 0;
}
</style>
