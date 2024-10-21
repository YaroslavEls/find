<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MessageItem from '@/Components/MessageItem.vue';
import MessageForm from '@/Components/MessageForm.vue';
import { Head, Link, useForm, usePage, router } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps({
    breadcrumbs: {
        type: Array,
        required: true
    },
    chat: {
        type: Object,
        required: true
    }
});

const form = useForm({
    text: ''
});

const textarea = ref(null);

const submit = () => {
    form.post(route('chat.message', { chat: props.chat }), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            props.chat.messages.sort((a, b) => {
                return new Date(a.created_at) - new Date(b.created_at);
            });
            textarea.value.style.height = 'auto';
        }
    })
};

onMounted(() => {
    const new_messages = usePage().props.auth.user.new_messages;
    const index = new_messages.indexOf(props.chat.id);
    if (index !== -1) {
        new_messages.splice(new_messages.indexOf(props.chat.id), 1);
    }
    
    Echo.join(`chat.${props.chat.id}`)
        .listen('MessageSent', (res) => {
            props.chat.messages.push(res.message);
        });
});

onBeforeUnmount(() => {
    router.post(route('chat.read', {chat: props.chat}));
    Echo.leave(`chat.${props.chat.id}`);
});

const author = (msg) => {
    if (!msg) return null;
    return msg.sender.userable_type === 'App\\Models\\Seeker' 
        ? { name: props.chat.seeker.name, photo: props.chat.seeker.photo }
        : { name: props.chat.saloon.name, photo: props.chat.saloon.logo };
};

</script>

<template>
    <Head title="Чат" />

    <MainLayout>
        <Breadcrumbs
            :items="breadcrumbs"
            class="mb-12"
        />

        <div class="max-w-[1184px] w-full mx-auto">
            <MessageItem
                v-for="(message, index) in chat.messages"
                :key="message.id"
                :message="message"
                :author="author(message)"
                :next="author(chat.messages[index + 1])"
            />

            <form
                v-if="!chat.archived"
                @submit.prevent="submit" 
                class="mt-10 mb-4"
            >
                <MessageForm
                    v-model:form="form"
                    v-model:area="textarea"
                />
            </form>

            <Link
                :href="route(chat.archived ? 'chat.unarchive' : 'chat.archive', { chat: props.chat })"
                :method="chat.archived ? 'delete' : 'post'"
                as="button"
                class="text-blue40 txt-text-buttons">
                {{ chat.archived ? 'Відновити чат з архіву' : 'Перемістити чат до архіву' }}
            </Link>
        </div>
    </MainLayout>
</template>
