<script setup>
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

const move = (name) => {
    model.value = name;
};

</script>

<template>
    <div class="flex items-center gap-2 mt-10 mb-14">
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
