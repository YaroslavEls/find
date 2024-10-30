<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
import Confirm from '@/Components/Modals/Confirm.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    seeker: {
        type: Object,
        required: true
    },
    reviews: {
        type: Array,
        required: true
    }
});

const form = useForm({
    score: 0,
    text: null
});

const submit = () => {
    form.post(route('review.store', { user: props.seeker.user.id }), {
        onSuccess: () => form.regenerate()
    });
};

const active = ref(null);
const modal = ref(null);

</script>

<template>
    <Head :title="'Відгуки про ' + seeker.name" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
        />

        <MqResponsive group>
            <template #desktop>
                <div class="flex items-center gap-6 mb-10">
                    <div
                        class="w-16 h-16 border-solid border-2 border-gray50 rounded-full image"
                        :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                    />
                    <div>
                        <div class="txt-h2">{{ seeker.name }}</div>
                        <div class="flex gap-1 mt-2">
                            <div
                                v-for="x in 5"
                                :key="x"
                                class="icon-star-small"
                                :class="seeker.score < x ? 'gray' : ''"
                            />
                        </div>
                    </div>
                </div>

                <div class="mb-4 text-gray40 txt-h3">
                    {{ reviews.length }} Відгуків
                </div>

                <form @submit.prevent="submit" class="mb-10">
                    <CreateForm 
                        v-model="form"
                        :count="reviews.length"
                    />
                </form>
            </template>

            <template #mobile>
                <div class="flex items-center gap-2 mb-8">
                    <div
                        class="max-w-14 w-full h-14 border-solid border-2 border-gray50 rounded-full image"
                        :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                    />
                    <div>
                        <div class="mb-1 txt-h3">{{ seeker.name }}</div>
                        <div class="flex gap-1">
                            <div
                                v-for="x in 5"
                                :key="x"
                                class="icon-star-small"
                                :class="seeker.score < x ? 'gray' : ''"
                            />
                        </div>
                    </div>
                </div>

                <form @submit.prevent="submit" class="mb-8">
                    <CreateForm 
                        v-model="form"
                        :count="reviews.length"
                    />
                </form>

                <div class="flex items-end gap-2 mb-4">
                    <div class="txt-h2">Відгуки</div>
                    <div class="text-gray40 txt-h4">{{ reviews.length }} </div>
                </div>
            </template>
        </MqResponsive>

        <ReviewItem
            v-for="review in reviews"
            :key="review.id"
            :review="review"
            v-model:selected="active"
            v-model:modal="modal"
        />

        <Confirm
            title="Видалити відгук?"
            subtitle="Ви впевнені що бажаєте видалити відгук?"
            v-show="modal"
            v-model="modal"
        />
    </MainLayout>
</template>
