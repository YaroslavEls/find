<script setup>
const props = defineProps({
    review: {
        type: Object,
        required: true
    }
});

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.review.created_at);
const formattedDate = formatter.format(date);

</script>

<template>
    <div class="flex gap-4 w-[69%] mb-8 p-4 bg-gray70 rounded-xl">
        <img 
            :src="'/' + review.author.userable.photo" 
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
</template>
