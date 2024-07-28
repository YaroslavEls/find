<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
import { useForm } from '@inertiajs/vue3';
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
    <MainLayout>
        
        <Breadcrumbs
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="mb-4 text-gray40 txt-h3">
            {{ reviews.length }} Відгуків
        </div>

        <form @submit.prevent="submit" class="mb-10">
            <CreateForm 
                v-model="form"
                :count="reviews.length"
            />
        </form>
        
        <ReviewItem
            v-for="(review, index) in reviews"
            :key="review.id"
            :review="review"
            v-model="active"
        />

    </MainLayout>
</template>
