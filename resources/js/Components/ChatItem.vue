<script setup>
import { MqResponsive } from "vue3-mq";
import { Link, usePage } from '@inertiajs/vue3';
import OptionsMenu from '@/Components/OptionsMenu.vue';

const props = defineProps({
    chat: {
        type: Object,
        required: true
    }
});

const model = defineModel({ 
    type: [Number, null],
    required: true 
});

const chatter = usePage().props.auth.user.userable_type === 'App\\Models\\Saloon' 
        ? { type: 'Кандидат',
            route: route('seekers.show', { seeker: props.chat.seeker.id }),
            name: props.chat.seeker.name, 
            photo: props.chat.seeker.photo }
        : { type: 'Роботодавець',
            route: route('vacancies', { saloon: props.chat.saloon.id }),
            name: props.chat.saloon.name, 
            photo: props.chat.saloon.logo };

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.chat.latest_message.created_at);
const formattedDate = formatter.format(date);

const latestSender = props.chat.latest_message.sender_id === usePage().props.auth.user.user_id
    ? 'Ви'
    : chatter.type;

const options = (x) => {
    if (model.value == x) {
        model.value = null;
        return;
    }
    model.value = x;
};

const menuItems = () => {
    if (props.chat.archived) {
        return { unarchive: route('chat.unarchive', { chat: props.chat }) }
    }

    return { archive: route('chat.archive', { chat: props.chat }) };
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="relative flex gap-10 mb-12 pb-5 border-solid border-b-[1px] border-gray50">
                <Link :href="chatter.route" class="basis-[30%]">
                    <div class="flex items-center gap-2 mb-4">
                        <img 
                            :src="'/' + chatter.photo"
                            class="w-8 h-8 border-solid border-1 border-gray50 rounded-full"
                        >
                        <div class="txt-h4">{{ chatter.name }}</div>
                    </div>
                </Link>

                <Link :href="route('chat.show', { chat: chat })" class="basis-[49%]">
                    <div class="flex justify-between items-center mb-2">
                        <div class="txt-h5">{{ latestSender }}</div>
                        <div class="text-gray30 txt-secondary">{{ formattedDate }}</div>
                    </div>
                    <div class="text-gray40 txt-body cropped-4">{{ chat.latest_message.text }}</div>
                </Link>

                <div
                    @click="options(chat.id)"
                    class="w-14 h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
                    :class="model == chat.id ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-show="model == chat.id" 
                    :items="menuItems()"
                />
            </div>
        </template>

        <template #mobile>
            <div class="relative mb-8 pb-4 border-solid border-b-[1px] border-gray50">
                <Link 
                    :href="chatter.route"
                    class="flex items-center gap-2 max-w-[80%] w-fit mb-2"
                >
                    <img 
                        :src="'/' + chatter.photo"
                        class="w-8 h-8 border-solid border-1 border-gray50 rounded-full"
                    >
                    <div class="text-gray30 txt-h5">{{ chatter.name }}</div>
                </Link>
                <Link 
                    :href="route('chat.show', { chat: chat })"
                    class="block w-[80%]"
                >
                    <div class="mb-2 txt-body cropped-2">{{ chat.latest_message.text }}</div>
                    <div class="text-gray30 txt-secondary">{{ formattedDate }}</div>
                </Link>

                <div
                    @click="options(chat.id)"
                    class="absolute top-2 right-2 w-[29px] h-5 rounded icon-options bg-center bg-no-repeat"
                    :class="model == chat.id ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-show="model == chat.id" 
                    :items="menuItems()"
                />
            </div>
        </template>
    </MqResponsive>
</template>
