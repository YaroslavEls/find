<script setup>
import { useMq } from 'vue3-mq';

const props = defineProps({
    message: {
        type: Object,
        required: true
    },
    author: {
        type: Object,
        required: true
    },
    next: {
        type: [Object, null],
        required: true
    }
});

const mq = useMq();

const date = new Date(props.message.created_at);
const today = new Date();
const options = {};
if (date.toDateString() === today.toDateString()) {
    options.hour = 'numeric';
    options.minute = 'numeric';
} else {
    options.day = 'numeric';
    options.month = 'long';
    options.year = 'numeric';
}
const formatter = new Intl.DateTimeFormat('uk-UA', options);
const formattedDate = formatter.format(date);

const separate = () => {
    return JSON.stringify(props.author) === JSON.stringify(props.next);
};

</script>

<template>
    <div :class="mq.desktop ? 'mb-10' : 'mb-4'">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center gap-2">
                <div
                    class="w-8 h-8 border-solid border-1 border-gray50 rounded-full image"
                    :style="{ backgroundImage: `url('/${author.photo}')` }"
                />
                <div class="text-gray30 txt-h5">
                    {{ author.name !== $page.props.auth.user.name ? author.name : 'Ви' }}
                </div>
            </div>
            <div class="text-gray40 txt-secondary">{{ formattedDate }}</div>
        </div>
        <div class="whitespace-pre-wrap txt-body">{{ message.text }}</div>
        <div 
            v-if="!separate() && next" 
            class="w-full h-[1px] bg-gray50"
            :class="mq.desktop ? 'mt-10' : 'my-6'"
        />
    </div>
</template>
