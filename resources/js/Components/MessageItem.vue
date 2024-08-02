<script setup>
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
    <div class="mb-10">
        <div class="flex justify-between items-center mb-2">
            <div class="flex items-center gap-2">
                <img 
                    :src="'/' + author.photo"
                    class="w-8 h-8 border-solid border-1 border-gray50 rounded-full"
                >
                <div class="text-gray30 txt-h5">
                    {{ author.name !== $page.props.auth.user.name ? author.name : 'Ви' }}
                </div>
            </div>
            <div class="text-gray40 txt-secondary">{{ formattedDate }}</div>
        </div>
        <div class="whitespace-pre-wrap txt-body">{{ message.text }}</div>
        <div v-if="!separate() && next" class="w-full h-[1px] mt-10 bg-gray50" />
    </div>
</template>
