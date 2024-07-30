<script setup>
const props = defineProps({
    message: {
        type: Object,
        required: true
    },
    author: {
        type: Object,
        required: true
    }
});

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.message.created_at);
const formattedDate = formatter.format(date);

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
        <div class="txt-body">{{ message.text }}</div>
    </div>
</template>
