<script setup>
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    saloon: {
        type: Object,
        required: true
    },
    reviews: {
        type: Array,
        required: true
    },
    isSeeker: {
        type: Boolean,
        required: true
    }
});

const form = useForm({
    score: 0,
    text: null
});

const submit = () => {
    form.post(route('review.store', { user: props.saloon.user.id }), {
        only: ['reviews'],
        onSuccess: () => form.regenerate(),
        onError: () => console.log(form)
    });
};

const active = ref(null);

</script>

<template>
    <div>
        <div class="mb-4 text-gray40 txt-h3">
            {{ reviews.length }} Відгуків
        </div>

        <form
            v-if="isSeeker"
            @submit.prevent="submit" 
            class="mb-10"
        >
            <CreateForm 
                v-model="form"
                :count="reviews.length"
            />
        </form>
        
        <ReviewItem
            v-for="(review, index) in reviews"
            :key="index"
            :review="review"
            v-model="active"
        />
    </div>
</template>
