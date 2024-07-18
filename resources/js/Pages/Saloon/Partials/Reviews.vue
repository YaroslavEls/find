<script setup>
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    saloon: {
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
    // console.log(props.saloon.user.id);
    form.post(route('review.store', { user: props.saloon.user.id }), {
        only: ['reviews'],
        onSuccess: () => form.reset(),
        onError: () => console.log(form)
    });
};

</script>

<template>
    <div>
        <form @submit.prevent="submit" class="mb-10">
            <CreateForm 
                v-model="form"
                :count="reviews.length"
            />
        </form>
        
        <ReviewItem
            v-for="(review, index) in reviews"
            :key="index"
            :review="review"
        />
    </div>
</template>
