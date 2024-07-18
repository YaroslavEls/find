<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Tags from '@/Components/Tags.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { Link } from '@inertiajs/vue3';

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

</script>

<template>
    <MainLayout>
        
        <Breadcrumbs
            :items="breadcrumbs"
            class="mt-16 mb-12"
        />

        <div class="flex justify-between mb-20">
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
                        <div class="txt-h4">{{ vacancy.location.city, vacancy.location.address }}</div>
                    </div>
                </div>

                <Link
                    :href="route('home', { vacancy: vacancy.id })"
                    class="block w-fit mb-10"
                >
                    <div class="mb-2 text-gray40 txt-body">Відгуки та рейтинг:</div>
                    <div class="flex items-center gap-2 txt-h4">
                        <div>{{ vacancy.score > 2 ? 'Позитивні' : 'Негативні' }} відгуки</div>
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
                        <div class="txt-h4">{{ vacancy.saloon.name }}</div>
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

                <SubmitButton
                    text="Відгукнутися на вакансію"
                    regular
                />
            </div>

            <div class="basis-[728px]">
                <div class="flex gap-2 px-6 py-2 mb-6 h-fit w-fit my-0 mr-0 ml-auto bg-blue50 rounded txt-body">
                    Зберегти
                    <div class="icon-fav" />
                </div>

                <img 
                    :src="'/' + vacancy.location.photos.split(';')[0]"
                    class="w-full h-[448px] border-solid border-gray50 border-2 rounded-xl"
                >
            </div>
        </div>
    </MainLayout>
</template>
