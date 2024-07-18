<script setup>
import SubmitButton from '@/Components/SubmitButton.vue';
import { ref, onMounted } from 'vue';

defineProps({
    count: {
        type: Number,
        required: true
    }
});

const model = defineModel({
    type: Object,
    required: true
});

const stars = [ref(null), ref(null), ref(null), ref(null), ref(null)];

const rate = (max) => {
    for (let i = 0; i < stars.length; i++) {
        stars[i].value[0].classList.add('gray');
    }

    for (let i = 0; i <= max; i++) {
        stars[i].value[0].classList.remove('gray');
    }

    model.value.score = max + 1;
};

const textarea = ref(null);

const resize = () => {
    textarea.value.style.height = 'auto';
    textarea.value.style.height = (textarea.value.scrollHeight + 5) + 'px';
};

onMounted(() => {
    // resize();
});

</script>

<template>
    <div class="flex justify-between mb-4 w-[69%]">
        <div class="text-gray40 txt-h3">
            {{ count }} Відгуків
        </div>
        <div class="flex gap-1">
            <div
                v-for="(item, index) in stars"
                :key="index"
                :ref="stars[index]"
                @click="rate(index)"
                class="cursor-pointer icon-star gray" 
            />
        </div>
    </div>

    <div class="flex gap-[3%]">
        <div class="basis-[69%]">
            <textarea
                rows="1"
                placeholder="Напишіть свій відгук"
                ref="textarea"
                @input="resize"
                v-model="model.text"
                class="max-h-[500px] p-4 w-full bg-background border-solid border-2 border-gray40 rounded-lg text-gray0 txt-body"
            ></textarea>

            <div v-if="Object.keys(model.errors).length > 0">
                <div
                    v-for="(value, key) in model.errors"
                    :key="key"
                    class="mt-1 text-systemred txt-secondary"
                >
                    {{ value }}
                </div>
            </div>
        </div>

        <div class="basis-[28%]">
            <SubmitButton
                text="Опублікувати"
            />
        </div>
    </div>
</template>
