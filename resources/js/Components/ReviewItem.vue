<script setup>
import OptionsMenu from '@/Components/OptionsMenu.vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
    review: {
        type: Object,
        required: true
    }
});

const model = defineModel({
    type: [Number, null],
    required: true
});

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.review.created_at);
const formattedDate = formatter.format(date);

const photo = usePage().url.startsWith('/seekers') 
    ? props.review.author.userable.logo 
    : props.review.author.userable.photo;

const options = (x) => {
    if (model.value == x) {
        model.value = null;
        return;
    }
    model.value = x;
};

const menuItems = {
    delete: route('review.delete', { review: props.review.id })
};

</script>

<template>
    <div class="relative flex justify-between">
        <div class="flex gap-4 w-[69%] mb-8 p-4 bg-gray70 rounded-xl">
            <img 
                :src="'/' + photo" 
                class="w-14 h-14 border-solid border-1 border-gray50 rounded-full"
            >

            <div class="grow">
                <div class="flex justify-between items-center">
                    <div class="txt-h4">{{ review.author.userable.name }}</div>
                    <div class="text-gray30 txt-secondary">{{ formattedDate }}</div>
                </div>

                <div class="flex gap-1 mb-4">
                    <div
                        v-for="x in 5"
                        :key="x"
                        class="icon-star-small"
                        :class="review.score < x ? 'gray' : ''"
                    />
                </div>
                
                <div class="whitespace-pre-wrap txt-body">{{ review.text }}</div>
            </div>
        </div>

        <div
            v-if="review.author_id == $page.props.auth.user.user_id"
            @click="options(review.id)"
            class="w-14 h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
            :class="model == review.id ? 'bg-gray70' : 'bg-gray50'"
        />

        <OptionsMenu
            v-show="model == review.id" 
            :items="menuItems"
        />
    </div>
</template>
