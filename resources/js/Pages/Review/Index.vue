<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
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
        onSuccess: () => form.regenerate(),
        onError: () => console.log(form)
    });
};

const active = ref(null);

</script>

<template>
    <Head :title="'Відгуки про ' + seeker.name" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
        />

        <MqResponsive group>
            <template #desktop>
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
                    <img 
                        :src="'/' + seeker.photo" 
                        class="w-14 h-14 border-solid border-2 border-gray50 rounded-full"
                    >
                    <div>
                        <div class="mb-1 txt-h4">{{ seeker.name }}</div>
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
            v-model="active"
        />
    </MainLayout>
</template>
