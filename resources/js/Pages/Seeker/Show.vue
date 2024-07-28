<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import Tags from '@/Components/Tags.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { router, Link, usePage } from '@inertiajs/vue3';

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
    <MainLayout>
        
        <Breadcrumbs
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="flex justify-between">
            <div class="basis-[49%]">
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
                        <div class="txt-h4">{{ age }} рік</div>
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
                        <div>Відгуки</div>
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

                <SubmitButton
                    text="Зв’язатися з кандидатом"
                    regular
                />
            </div>

            <div class="basis-[576px]">
                <div 
                    @click="save"
                    class="flex gap-2 px-6 py-2 mb-6 h-fit w-fit my-0 mr-0 ml-auto bg-blue50 rounded txt-body cursor-pointer"
                >
                    {{ saveData.label }}
                    <div class="icon-fav" />
                </div>

                <img 
                    :src="'/' + seeker.photo"
                    class="w-full h-[448px] border-solid border-gray50 border-2 rounded-xl"
                >
            </div>
        </div>
    </MainLayout>
</template>
