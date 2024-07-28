<script setup>
const props = defineProps({
    stars: {
        type: Array,
        required: true
    }
});

const model = defineModel({
    type: Number,
    required: true
});

const rate = (max) => {
    for (let i = 0; i < props.stars.length; i++) {
        props.stars[i].value[0].classList.add('gray');
    }

    for (let i = 0; i <= max; i++) {
        props.stars[i].value[0].classList.remove('gray');
    }

    model.value = max + 1;
};

</script>

<template>
    <div class="flex gap-1">
        <div
            v-for="(item, index) in stars"
            :key="index"
            :ref="stars[index]"
            @click="rate(index)"
            class="cursor-pointer icon-star gray" 
        />
    </div>
</template>
