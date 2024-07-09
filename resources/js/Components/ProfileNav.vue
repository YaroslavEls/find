<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    names: {
        type: Object,
        required: true
    }
});

const model = defineModel({ 
    type: String,
    required: true 
});
const form = defineModel('form', { 
    type: Object,
    required: false 
});

const move = (name) => {
    if (form.value) {
        form.value.reset();
    }
    model.value = name;
};

</script>

<template>
    <div class="flex items-center gap-4 mt-16 mb-10">
        <div class="txt-h1">Мій Профіль</div>
        <Link 
            :href="route('logout')"
            method="post"
            as="button"
            class="flex items-center gap-2"
        >
            <div class="text-blue40 txt-text-buttons">Вийти з акаунту</div>
            <div class="icon-logout" />
        </Link>
    </div>

    <div class="flex items-center gap-2 mb-14">
        <div
            v-for="(value, key) in names"
            :key="key"
            @click="move(key)"
            class="px-6 py-2 rounded cursor-pointer txt-body"
            :class="model == key ? 'bg-blue50' : 'bg-gray50'"
        >
            {{ value }}
        </div>
    </div>
</template>
