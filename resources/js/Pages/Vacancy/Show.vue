<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Tags from '@/Components/Tags.vue';
import Schedule from '@/Components/Schedule.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { Carousel, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { Head, router, Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

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

const reviews = props.vacancy.score == 0
    ? 'Відгуки відсутні'
    : props.vacancy.score < 2
        ? 'Негативні відгуки'
        : props.vacancy.score < 3.5
            ? 'Середні відгуки'
            : 'Позитивні відгуки';

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.vacancy.created_at);
const formattedDate = formatter.format(date);

const mediaMode = ref(0);

const isSeeker = usePage().props.auth.user.userable_type === 'App\\Models\\Seeker';

const saveData = {
    route: route('save.vacancy', { vacancy: props.vacancy }), 
    method: 'post', 
    label: 'Зберегти'
};
if (usePage().props.auth.user.saves.includes(props.vacancy.id)) {
    saveData.route = route('unsave.vacancy', { vacancy: props.vacancy });
    saveData.method = 'delete';
    saveData.label = 'Видалити зі збереженого';
}

const save = () => {
    router.visit(saveData.route, {
        method: saveData.method,
        preserveScroll: true
    });
};

</script>

<template>
    <Head :title="vacancy.job" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
        />

        <MqResponsive group>
            <template #desktop>
                <div class="flex justify-between gap-6">
                    <div class="basis-[728px]">
                        <Tags
                            :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                            class="mb-10"
                        />

                        <div class="mb-10 txt-h1">
                            {{ vacancy.job }} - 
                            <span class="text-systemgreen txt-h3">{{ (+vacancy.salary).toLocaleString('de-DE') }}₴</span>
                        </div>

                        <div class="flex gap-4 mb-8">
                            <div class="basis-6/12">
                                <div class="mb-2 text-gray40 txt-body">Кав’ярня (Мережа):</div>
                                <Link
                                    :href="route('saloons.show', { vacancy: vacancy.id })"
                                    class="flex items-center gap-2 w-fit"
                                >
                                    <div
                                        class="w-6 h-6 rounded-full border-solid border border-gray50 image"
                                        :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                                    />
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
                                <div>{{ reviews }}</div>
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
                                <div class="flex gap-2 items-center">
                                    <div class="icon-gen" />
                                    <div class="txt-h4">{{ vacancy.location.gen ? 'Маємо генератор' : 'Генератори відсутні' }}</div>
                                </div>
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

                    <div class="basis-[576px]">
                        <div
                            v-if="isSeeker"
                            @click="save"
                            class="flex gap-2 px-6 py-2 mb-[125px] h-fit w-fit my-0 mr-0 ml-auto bg-blue50 rounded txt-body cursor-pointer"
                        >
                            {{ saveData.label }}
                            <div class="icon-fav" />
                        </div>

                        <div class="flex justify-between mb-4" :class="isSeeker ? '' : 'mt-[166px]'">
                            <div class="text-gray40 txt-h3">Локація:</div>
                            <div class="flex gap-2">
                                <div
                                    @click="mediaMode = 0"
                                    class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer"
                                    :class="mediaMode === 0 ? 'bg-blue50' : 'bg-gray60'"
                                >
                                    <div class="txt-body">Фото</div>
                                    <div class="icon-photo" />
                                </div>
                                <div
                                    @click="mediaMode = 1"
                                    class="flex items-center gap-2 px-4 py-2 rounded cursor-pointer"
                                    :class="mediaMode === 1 ? 'bg-blue50' : 'bg-gray60'"
                                >
                                    <div class="txt-body">Відео</div>
                                    <div class="icon-video" />
                                </div>
                            </div>
                        </div>

                        <div v-show="mediaMode === 1">
                            <video
                                v-if="vacancy.location.video"
                                height="355"
                                controls
                                class="border-solid border-gray50 border-2 rounded-xl"
                            >
                                <source :src="'/'+vacancy.location.video">
                                Your browser does not support the video tag.
                            </video>
                            <div 
                                v-else
                                class="flex justify-center items-center w-full h-[355px] bg-gray50 rounded-xl txt-h4"
                            >
                                Відео відсутнє
                            </div>
                        </div>
                        
                        <Carousel v-show="mediaMode === 0" :autoplay="5000" :transition="750" :wrap-around="true">
                            <Slide 
                                v-for="(photo, index) in vacancy.location.photos.split(';')" 
                                :key="index"
                                class="relative cursor-grab"
                            >
                                <div
                                    class="w-full h-[355px] border-solid border-gray50 border-2 rounded-xl image"
                                    :style="{ backgroundImage: `url('/${photo}')` }"
                                />
                                <div class="absolute right-4 bottom-2 txt-h5">{{ index + 1 }}/{{ vacancy.location.photos.split(';').length }}</div>
                            </Slide>
                        </Carousel>

                        <div class="mt-10">
                            <div class="mb-4 text-gray40 txt-h3">Соціальні мережі:</div>
                            <div
                                v-for="(item, index) in vacancy.saloon.socials.split(';')"
                                :key="index"
                                class="p-4 mb-6 rounded-lg bg-gray80 txt-body"
                            >
                                {{ item }}
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <template #mobile>
                <div class="flex justify-between items-center mb-4">
                    <div class="txt-h2">{{ vacancy.job }}</div>
                    <div
                        v-if="isSeeker"
                        @click="save" 
                        class="icon-fav big" 
                        :class="saveData.method === 'post' ? '' : 'filled'"
                    />
                </div>
                <div class="mb-4 text-systemgreen txt-h3">{{ (+vacancy.salary).toLocaleString('de-DE') }}₴</div>

                <Tags
                    :tags="{ date: vacancy.updated_at, exp: vacancy.experience, empl: vacancy.employment }"
                    class="mb-8"
                />

                <div class="mb-2 text-gray40 txt-body">Кав'ярня (мережа):</div>
                <Link
                    :href="route('saloons.show', { vacancy: vacancy.id })"
                    class="flex items-center gap-2 w-fit mb-6"
                >
                    <div
                        class="w-6 h-6 rounded-full border-solid border border-gray50 image"
                        :style="{ backgroundImage: `url('/${vacancy.saloon.logo}')` }"
                    />
                    <div class="text-blue30 txt-h4">{{ vacancy.saloon.name }}</div>
                </Link>

                <div class="mb-2 text-gray40 txt-body">Локація:</div>
                <Link
                    :href="route('location.show', { vacancy: vacancy.id, location: vacancy.location.id })"
                    class="block mb-6 txt-h5"
                >
                    {{ vacancy.location.city }}, {{ vacancy.location.address }}
                </Link>

                <div class="mb-2 text-gray40 txt-body">Відгуки та рейтинг:</div>
                <Link
                    :href="route('saloons.show', { vacancy: vacancy.id, sec: 'reviews' })"
                    class="flex items-center gap-2 w-fit mb-6 txt-h4"
                >
                    <div>{{ reviews }}</div>
                    <div>-</div>
                    <div class="flex gap-1">
                        <div
                            v-for="x in 5"
                            :key="x"
                            class="icon-star-small"
                            :class="vacancy.score < x ? 'gray' : ''"
                        />
                    </div>
                </Link>

                <div class="mb-2 text-gray40 txt-body">Наявність світла:</div>
                <div class="flex gap-2 items-center mb-6">
                    <div class="icon-gen" />
                    <div class="txt-h4">{{ vacancy.location.gen ? 'Маємо генератор' : 'Генератори відсутні' }}</div>
                </div>

                <div class="mb-2 text-gray40 txt-body">Графік роботи закладу:</div>
                <Schedule
                    :schedule="vacancy.location.schedule"
                    class="mb-10"
                />

                <Link
                    v-if="isSeeker"
                    :href="route('chat.create', { user: vacancy.saloon.user.id })"
                    class="block mb-10"
                >
                    <SubmitButton
                        text="Відгукнутися на вакансію"
                        regular
                    />
                </Link>

                <div class="mb-2 text-gray40 txt-h3">Опис вакансії:</div>
                <div class="whitespace-pre-wrap mb-10 txt-body">{{ vacancy.descr }}</div>

                <div class="flex justify-between mb-2">
                    <div class="text-gray40 txt-h3">Локація:</div>
                    <div class="flex gap-2">
                        <div
                            @click="mediaMode = 0"
                            class="flex items-center gap-1 px-2 py-1 rounded cursor-pointer"
                            :class="mediaMode === 0 ? 'bg-blue50' : 'bg-gray60'"
                        >
                            <div class="txt-body">Фото</div>
                            <div class="icon-photo" />
                        </div>
                        <div
                            @click="mediaMode = 1"
                            class="flex items-center gap-1 px-2 py-1 rounded cursor-pointer"
                            :class="mediaMode === 1 ? 'bg-blue50' : 'bg-gray60'"
                        >
                            <div class="txt-body">Відео</div>
                            <div class="icon-video" />
                        </div>
                    </div>
                </div>

                <div v-show="mediaMode === 1">
                    <video 
                        v-if="vacancy.location.video" 
                        height="202"
                        controls
                        class="border-solid border-gray50 border-2 rounded-lg"
                    >
                        <source :src="'/'+vacancy.location.video">
                        Your browser does not support the video tag.
                    </video>
                    <div 
                        v-else
                        class="flex justify-center items-center w-full h-[202px] bg-gray50 rounded-xl txt-h4"
                    >
                        Відео відсутнє
                    </div>
                </div>

                <Carousel v-show="mediaMode === 0" :autoplay="5000" :transition="750" :wrap-around="true">
                    <Slide 
                        v-for="(photo, index) in vacancy.location.photos.split(';')" 
                        :key="index"
                        class="relative cursor-grab"
                    >
                        <div
                            class="w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                            :style="{ backgroundImage: `url('/${photo}')` }"
                        />
                        <div class="absolute right-4 bottom-2 txt-h5">
                            {{ index + 1 }}/{{ vacancy.location.photos.split(';').length }}
                        </div>
                    </Slide>
                </Carousel>

                <div class="mt-6 mb-2 text-gray40 txt-body">Соціальні мережі:</div>
                <div class="mb-10">
                    <div
                        v-for="(item, index) in vacancy.saloon.socials.split(';')"
                        :key="index"
                        class="mb-4 txt-body"
                    >
                        {{ item }}
                    </div>
                </div>
                
                <div class="flex items-center gap-1 mb-4 text-gray40 txt-body">
                    <div class="icon-date gray" />
                    Опубліковано - {{ formattedDate }}
                </div>

                <Link
                    v-if="isSeeker"
                    :href="route('chat.create', { user: vacancy.saloon.user.id })"
                    class="block mb-10"
                >
                    <SubmitButton
                        text="Відгукнутися на вакансію"
                        regular
                    />
                </Link>
            </template>
        </MqResponsive>
    </MainLayout>
</template>

<style>
section.carousel {
    text-align: unset;
    padding: 0;
}
</style>
