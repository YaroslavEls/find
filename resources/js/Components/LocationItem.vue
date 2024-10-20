<script setup>
import { MqResponsive } from "vue3-mq";
import Schedule from '@/Components/Schedule.vue';
import OptionsMenu from '@/Components/OptionsMenu.vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    location: { 
        type: Object,
        required: true 
    },
    index: { 
        type: Number,
        required: true 
    }
});

const selected = defineModel('selected', { 
    type: [Number, null],
    required: true 
});
const modal = defineModel('modal', {
    type: [String, null],
    required: false
});

const options = (x) => {
    if (selected.value == x) {
        selected.value = null;
        return;
    }
    selected.value = x;
};

const menuItems = {
    edit: route('location.edit', { location: props.location.id }),
    delete: route('location.delete', { location: props.location.id })
};

const url = !usePage().url.startsWith('/profile') 
    ? route('location.show', { vacancy: usePage().url.split('/')[2], location: props.location.id })
    : null;

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="relative flex mb-12">
                <Link
                    v-if="!$page.url.startsWith('/profile')"
                    :href="url"
                    class="mr-8"
                >
                    <div
                        class="w-[424px] h-[272px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${location.photos.split(';')[0]}')` }"
                    />
                </Link>

                <div
                    v-else
                    class="w-[424px] h-[272px] mr-8 border-solid border-2 border-gray50 rounded-lg image"
                    :style="{ backgroundImage: `url('/${location.photos.split(';')[0]}')` }"
                />

                <div class="grow mr-8">
                    <div class="mb-6 txt-h2">{{ location.name }}</div>
                    <div class="mb-2 text-gray40 txt-body">Адреса:</div>
                    <div class="mb-6 txt-h4">{{ location.city }}, {{ location.address }}</div>
                    <div v-if="location.gen" class="flex gap-2 items-center mb-6">
                        <div class="icon-gen" />
                        <div class="txt-h4">Маємо генератор</div>
                    </div>
                    <div class="mb-2 text-gray40 txt-body">Графік роботи закладу:</div>
                    <Schedule
                        :schedule="location.schedule"
                    />
                </div>

                <div
                    v-if="$page.url.startsWith('/profile')"
                    @click="options(index)"
                    class="max-w-14 w-full h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat bg-gray60 cursor-pointer hover:bg-gray70 duration-300"
                    :class="selected == index ? 'close' : ''"
                />

                <OptionsMenu
                    v-if="$page.url.startsWith('/profile')"
                    v-show="selected == index" 
                    :items="menuItems"
                    v-model="modal"
                />
            </div>
        </template>

        <template #mobile>
            <div class="relative mb-8">
                <div
                    v-if="$page.url.startsWith('/profile')"
                    @click="options(index)"
                    class="absolute top-2 right-2 w-[29px] h-5 rounded icon-options bg-center bg-no-repeat"
                    :class="selected == index ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-if="$page.url.startsWith('/profile')"
                    v-show="selected == index" 
                    :items="menuItems"
                    v-model="modal"
                />

                <Link 
                    v-if="!$page.url.startsWith('/profile')"
                    :href="url" 
                    class="block mb-4"
                >
                    <div
                        class="w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${location.photos.split(';')[0]}')` }"
                    />
                </Link>

                <div
                    v-else
                    class="w-full mb-4 h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                    :style="{ backgroundImage: `url('/${location.photos.split(';')[0]}')` }"
                />

                <div class="mb-4 txt-h2">{{ location.name }}</div>
                <div class="mb-2 text-gray40 txt-body">Адреса:</div>
                <div class="mb-4 txt-h5">{{ location.city }}, {{ location.address }}</div>
                <div v-if="location.gen" class="flex gap-1 items-center mb-4">
                    <div class="icon-gen" />
                    <div class="txt-h5">Маємо генератор</div>
                </div>
                <div class="mb-2 text-gray40 txt-body">Графік роботи закладу:</div>
                <Schedule
                    :schedule="location.schedule"
                />
            </div>
        </template>
    </MqResponsive>
</template>
