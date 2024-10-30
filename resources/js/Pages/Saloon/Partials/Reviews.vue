<script setup>
import { MqResponsive } from "vue3-mq";
import CreateForm from '@/Pages/Review/Partials/CreateForm.vue';
import ReviewItem from '@/Components/ReviewItem.vue';
import Confirm from '@/Components/Modals/Confirm.vue';
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
        onSuccess: () => form.regenerate()
    });
};

const active = ref(null);
const modal = ref(null);

</script>

<template>
    <div>
        <MqResponsive group>
            <template #desktop>
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
            </template>

            <template #mobile>
                <form
                    v-if="isSeeker"
                    @submit.prevent="submit" 
                    class="mb-8"
                >
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
    </div>
</template>
