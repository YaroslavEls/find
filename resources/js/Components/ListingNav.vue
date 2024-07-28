<script setup>
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
    <div class="flex justify-between items-center mb-14">
        <div class="flex items-end gap-4">
            <div class="txt-h1">{{ heading }}</div>
            <div class="text-gray40 txt-h3">{{ count }}</div>
        </div>

        <div class="relative flex gap-28">
            <div class="flex gap-2">
                <Link
                    :href="path"
                    class="px-6 py-2 h-fit rounded txt-body"
                    :class="(sort !== 'new' && sort !== 'saved') ? 'bg-blue50' : 'bg-gray50'"
                >
                    Усі
                </Link>
                <Link
                    :href="path + '?sort=new'"
                    class="px-6 py-2 h-fit rounded txt-body"
                    :class="sort == 'new' ? 'bg-blue50' : 'bg-gray50'"
                >
                    Нові
                </Link>
                <Link
                    v-if="isSeeker"
                    :href="path + '?sort=saved'"
                    class="flex gap-2 px-6 py-2 h-fit rounded txt-body"
                    :class="sort == 'saved' ? 'bg-blue50' : 'bg-gray50'"
                >
                    Обрані
                    <div class="icon-fav" />
                </Link>
            </div>

            <div
                @click="active = !active"
                class="flex gap-2 px-6 py-2 h-fit bg-blue50 rounded txt-body cursor-pointer"
            >
                Фільтрувати
                <div class="icon-filter" />
            </div>

            <Transition>
                <Filters
                    v-show="active"
                    :route="route"
                    v-model="active"
                />
            </Transition>
        </div>
    </div>
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
