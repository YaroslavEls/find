<script setup>
import { Link } from '@inertiajs/vue3';
import { useMq } from "vue3-mq";

defineProps({
    items: { 
        type: Object,
        required: true 
    },
    bg: {
        type: Boolean,
        required: false,
        default: false
    }
});

const model = defineModel({
    type: [String, null],
    required: false
});

const mq = useMq();

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
        text: 'Видалити зі збереженого',
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
    },
    activate: {
        method: 'post',
        text: 'Активувати',
        icon: 'icon-activate'
    },
    deactivate: {
        method: 'post',
        text: 'Деактивувати',
        icon: 'icon-deactivate'
    }
};

const show = (href) => {
    document.documentElement.style.overflow = 'hidden';
    model.value = href;
};

</script>

<template>
    <Transition name="fade">
        <div 
            class="absolute border-2 border-gray40 bg-background z-10 text-gray0"
            :class="[
                mq.desktop
                    ? 'top-12 right-0 px-4 py-2 rounded-lg' 
                    : 'top-8 right-2 px-2 py-1 rounded'
            ]"
        >
            <div 
                v-for="(value, key) in items" 
                :key="key"
                class="last:mb-0"
                :class="mq.desktop ? 'mb-4' : 'mb-2'"
            >
                <div 
                    v-if="key === 'delete'"
                    @click="show(value)"
                    class="flex justify-between w-full txt-secondary cursor-pointer"
                    :class="mq.desktop ? 'gap-6' : 'gap-4'"
                >
                    {{ params[key]['text'] }}
                    <div :class="params[key]['icon']" />
                </div>
                <Link
                    v-else
                    :href="value"
                    :method="params[key]['method']"
                    as="button"
                    preserve-scroll
                    class="flex justify-between w-full txt-secondary"
                    :class="mq.desktop ? 'gap-6' : 'gap-4'"
                    
                >
                    {{ params[key]['text'] }}
                    <div :class="params[key]['icon']" />
                </Link>
            </div>
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
