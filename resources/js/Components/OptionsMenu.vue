<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    items: { 
        type: Object,
        required: true 
    }
});

const params = {
    edit: {
        method: 'get',
        text: 'Редагувати',
        icon: 'icon-edit'
    },
    delete: {
        method: 'delete',
        text: 'Видалити',
        icon: 'icon-delete'
    },
    save: {
        method: 'post',
        text: 'Зберегти',
        icon: 'icon-fav'
    },
    unsave: {
        method: 'delete',
        text: 'Видалити',
        icon: 'icon-fav'
    },
    archive: {
        method: 'post',
        text: 'Архівувати',
        icon: 'icon-archive'
    },
    unarchive: {
        method: 'delete',
        text: 'Розархівувати',
        icon: 'icon-archive'
    }
};

</script>

<template>
    <Transition name="fade">
        <div class="absolute top-12 right-0 w-[174px] px-4 py-2 rounded-lg bg-gray70">
            <Link
                v-for="(value, key) in items"
                :key="key"
                :href="value"
                :method="params[key]['method']"
                as="button"
                preserve-scroll
                class="flex justify-between w-full mb-4 last:mb-0 txt-secondary"
            >
                {{ params[key]['text'] }}
                <div :class="params[key]['icon']" />
            </Link>
        </div>
    </Transition>
</template>

<style scoped>
.fade-enter-active {
    transition: all 0.3s ease-out;
}

.fade-leave-active {
    transition: all 0.3s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
