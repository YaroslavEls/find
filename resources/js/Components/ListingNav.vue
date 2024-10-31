<script setup>
import { MqResponsive } from "vue3-mq";
import Filters from '@/Components/Filters.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    heading: {
        type: String,
        required: true
    },
    count: {
        type: Number,
        required: true
    },
    route: {
        type: String,
        required: true
    },
    isSeeker: {
        type: Boolean,
        required: false,
        default: true
    }
});

const path = window.location.origin + window.location.pathname;
const urlParams = new URLSearchParams(window.location.search);
const sort = ref(urlParams.get('sort'));

const active = ref(false);

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="flex justify-between items-center gap-16 mb-14">
                <div class="flex justify-between items-center max-w-[1184px] w-full">
                    <div class="flex items-end gap-4">
                        <div class="txt-h1">{{ heading }}</div>
                        <div class="text-gray40 txt-h3">{{ count }}</div>
                    </div>

                    <div class="flex gap-2">
                        <Link
                            :href="path"
                            class="px-6 py-2 h-fit rounded txt-body"
                            :class="(sort !== 'new' && sort !== 'saved') ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Усі
                        </Link>
                        <Link
                            :href="path + '?sort=new'"
                            class="px-6 py-2 h-fit rounded txt-body"
                            :class="sort == 'new' ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Нові
                        </Link>
                        <Link
                            v-if="isSeeker"
                            :href="path + '?sort=saved'"
                            class="flex gap-2 px-6 py-2 h-fit rounded txt-body"
                            :class="sort == 'saved' ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Збережені
                            <div class="icon-fav" />
                        </Link>
                    </div>
                </div>

                <div class="relative">
                    <div
                        @click="active = !active"
                        class="flex gap-2 px-6 py-2 h-fit bg-blue50 rounded txt-body cursor-pointer"
                    >
                        Фільтри
                        <div class="icon-filter" />
                    </div>

                    <Transition>
                        <Filters
                            v-if="active"
                            :route="route"
                            v-model="active"
                        />
                    </Transition>
                </div>
            </div>
        </template>

        <template #mobile>
            <div class="relative mb-6">
                <div class="flex items-end gap-2 mb-4">
                    <div class="txt-h1">{{ heading }}</div>
                    <div class="text-gray40 txt-h3">{{ count }}</div>
                </div>

                <div class="flex justify-between items-center flex-wrap gap-y-4">
                    <div class="flex gap-2">
                        <Link
                            :href="path"
                            class="px-3 py-1 h-7 rounded txt-body"
                            :class="(sort !== 'new' && sort !== 'saved') ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Усі
                        </Link>
                        <Link
                            :href="path + '?sort=new'"
                            class="px-3 py-1 h-7 rounded txt-body"
                            :class="sort == 'new' ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Нові
                        </Link>
                        <Link
                            v-if="isSeeker"
                            :href="path + '?sort=saved'"
                            class="px-3 py-1 h-7 rounded txt-body"
                            :class="sort == 'saved' ? 'bg-blue50' : 'bg-gray60'"
                        >
                            Збережені
                        </Link>
                    </div>

                    <div
                        @click="active = !active"
                        class="flex gap-2 px-3 py-1 h-7 bg-blue50 rounded txt-body"
                    >
                        Фільтри
                        <div class="icon-filter" />
                    </div>

                    <Transition>
                        <Filters
                            v-if="active"
                            :route="route"
                            v-model="active"
                        />
                    </Transition>
                </div>
            </div>
        </template>
    </MqResponsive>
</template>

<style scoped>
.v-enter-active {
    transition: all 0.3s ease-out;
}

.v-leave-active {
    transition: all 0.3s ease-out;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
