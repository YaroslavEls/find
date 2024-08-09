<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Breadcrumbs from '@/Components/Breadcrumbs.vue';
import MessageItem from '@/Components/MessageItem.vue';
import MessageForm from '@/Components/MessageForm.vue';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useMq } from 'vue3-mq';

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

const mq = useMq();

const form = useForm({
    text: ''
});

const textarea = ref(null);

const submit = () => {
    form.post(route('chat.message', { chat: props.chat }), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            incoming.value.length = 0;
            textarea.value.style.height = 'auto';
        }
    })
};

onMounted(() => {
    Echo.private(`chat.${usePage().props.auth.user.user_id}`)
        .listen('MessageSent', (res) => {
            incoming.value.push(res.message);
        })
});

const incoming = ref([]);

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

            <div
                v-show="incoming.length > 0"
                class="border-solid border-blue50 border-b-[1px] text-blue50 text-right txt-text-buttons"
                :class="mq.desktop ? 'mb-10 pb-2' : 'my-6 pb-1'"
            >
                Нові повідомлення
            </div>

            <MessageItem
                v-for="message in incoming"
                :key="message.id"
                :message="message"
                :author="author(message)"
                :next="null"
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
