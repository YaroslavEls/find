<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Tags from '@/Components/Tags.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { Head, router, Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    seeker: {
        type: Object,
        required: true
    }
});

const age = Math.floor(
    (new Date() - new Date(props.seeker.birthday).getTime()) / 3.15576e+10
);
let suffix = '';

switch (age % 10) {
    case 1:
        suffix = 'рік';
        break;
    case 2:
    case 3:
    case 4:
        suffix = 'роки';
        break;
    default:
        suffix = 'років';
}

const reviews = props.seeker.score == 0
    ? 'Відгуки відсутні'
    : props.seeker.score < 2
        ? 'Негативні відгуки'
        : props.seeker.score < 3.5
            ? 'Середні відгуки'
            : 'Позитивні відгуки';

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.seeker.created_at);
const formattedDate = formatter.format(date);

const saveData = {
    route: route('save.seeker', { seeker: props.seeker }), 
    method: 'post', 
    label: 'Додати до обраного' 
};
if (usePage().props.auth.user.saves.includes(props.seeker.id)) {
    saveData.route = route('unsave.seeker', { seeker: props.seeker });
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
    <Head :title="seeker.name" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
        />

        <MqResponsive group>
            <template #desktop>
                <div class="flex justify-between gap-6">
                    <div class="basis-[728px]">
                        <Tags
                            :tags="{ date: seeker.updated_at, exp: seeker.experience, empl: seeker.employment }"
                            class="mb-10"
                        />

                        <div class="mb-10 txt-h1">
                            {{ seeker.job }} - 
                            <span class="text-systemgreen txt-h3">{{ seeker.salary }}₴</span>
                        </div>

                        <div class="flex gap-4 mb-8">
                            <div class="basis-4/12">
                                <div class="mb-2 text-gray40 txt-body">Ім'я:</div>
                                <div class="txt-h4">{{ seeker.name }}</div>
                            </div>
                            <div class="basis-4/12">
                                <div class="mb-2 text-gray40 txt-body">Вік:</div>
                                <div class="txt-h4">{{ age }} {{ suffix }}</div>
                            </div>
                            <div class="basis-4/12">
                                <div class="mb-2 text-gray40 txt-body">Локація:</div>
                                <div class="txt-h4">{{ seeker.city }}</div>
                            </div>
                        </div>

                        <Link
                            :href="route('seekers.reviews', { seeker: seeker.id })"
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
                                        :class="seeker.score < x ? 'gray' : ''"
                                    />
                                </div>
                            </div>
                        </Link>

                        <div class="mb-10">
                            <div class="mb-4 text-gray40 txt-h3">Про кандидата:</div>
                            <div class="whitespace-pre-wrap txt-body">{{ seeker.info }}</div>
                        </div>

                        <div class="flex items-center gap-1 mb-4 text-gray40 txt-body">
                            <div class="icon-date gray" />
                            Опубліковано - {{ formattedDate }}
                        </div>

                        <Link :href="route('chat.create', { user: seeker.user.id })">
                            <SubmitButton
                                text="Зв’язатися з кандидатом"
                                regular
                            />
                        </Link>
                    </div>

                    <div class="basis-[576px]">
                        <div 
                            @click="save"
                            class="flex gap-2 px-6 py-2 mb-6 h-fit w-fit my-0 mr-0 ml-auto bg-blue50 rounded txt-body cursor-pointer"
                        >
                            {{ saveData.label }}
                            <div class="icon-fav" />
                        </div>

                        <div
                            class="w-full h-[448px] border-solid border-gray50 border-2 rounded-xl image"
                            :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                        />
                    </div>
                </div>
            </template>

            <template #mobile>
                <div class="flex justify-between items-end mb-4">
                    <div class="txt-h2">{{ seeker.job }}</div>
                    <div @click="save" class="icon-fav" />
                </div>
                <div class="mb-4 text-systemgreen txt-h3">{{ seeker.salary }}₴</div>
                <Tags
                    :tags="{ date: seeker.updated_at, exp: seeker.experience, empl: seeker.employment }"
                    class="mb-8"
                />
                <div class="mb-2 text-gray40 txt-body">Ім'я:</div>
                <div class="mb-6 txt-h5">{{ seeker.name }}</div>
                <div class="mb-2 text-gray40 txt-body">Вік:</div>
                <div class="mb-6 txt-h5">{{ age }} {{ suffix }}</div>
                <div class="mb-2 text-gray40 txt-body">Локація:</div>
                <div class="mb-6 txt-h5">{{ seeker.city }}</div>
                <div class="mb-2 text-gray40 txt-body">Відгуки та рейтинг:</div>
                <Link
                    :href="route('seekers.reviews', { seeker: seeker.id })"
                    class="flex items-center gap-2 w-fit mb-10 txt-h4"
                >
                    <div>{{ reviews }}</div>
                    <div>-</div>
                    <div class="flex gap-1">
                        <div
                            v-for="x in 5"
                            :key="x"
                            class="icon-star-small"
                            :class="seeker.score < x ? 'gray' : ''"
                        />
                    </div>
                </Link>
                <Link 
                    :href="route('chat.create', { user: seeker.user.id })" 
                    class="block mb-10"
                >
                    <SubmitButton
                        text="Зв’язатися з кандидатом"
                        regular
                    />
                </Link>
                <div class="mb-2 text-gray40 txt-h3">Про кандидата:</div>
                <div class="whitespace-pre-wrap mb-10 txt-body">{{ seeker.info }}</div>
                <div class="mb-2 text-gray40 txt-h3">Фото:</div>
                <div
                    class="mb-10 w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                    :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                />
                <div class="flex items-center gap-1 mb-4 text-gray40 txt-body">
                    <div class="icon-date gray" />
                    Опубліковано - {{ formattedDate }}
                </div>
                <Link :href="route('chat.create', { user: seeker.user.id })">
                    <SubmitButton
                        text="Зв’язатися з кандидатом"
                        regular
                    />
                </Link>
            </template>
        </MqResponsive>
    </MainLayout>
</template>
