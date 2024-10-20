<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ChatsNav from '@/Components/ChatsNav.vue';
import EmptyListing from '@/Components/EmptyListing.vue';
import ChatItem from '@/Components/ChatItem.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { useMq } from 'vue3-mq';

defineProps({
    chats: {
        type: Array,
        required: true
    }
});

const mq = useMq();

const path = window.location.origin + window.location.pathname;
const urlParams = new URLSearchParams(window.location.search);
const sort = ref(urlParams.get('sort'));

const selected = ref(null);

</script>

<template>
    <Head title="Чати" />

    <MainLayout>
        <ChatsNav />

        <EmptyListing v-if="chats.length === 0" />

        <ChatItem
            v-for="chat in chats"
            :key="chat.id"
            :chat="chat"
            v-model="selected"
        />

        <Link
            v-if="mq.desktop"
            :href="sort === 'archive' ? path : path + '?sort=archive'" 
            class="block w-fit mt-14 mr-0 ml-auto px-6 py-2 h-fit rounded txt-body bg-blue50">
            {{ sort === 'archive' ? 'Повернутись з архіву' : 'Перейти до архіву' }}
        </Link>
    </MainLayout>
</template>
