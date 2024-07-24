<script setup>
import Stars from '@/Components/Inputs/Stars.vue';
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

const textarea = ref(null);

const resize = () => {
    textarea.value.style.height = 'auto';
    textarea.value.style.height = (textarea.value.scrollHeight + 5) + 'px';
};

</script>

<template>
    <div class="flex gap-[3%]">
        <div class="relative basis-[69%]">
            <Stars
                v-model="model.score"
                class="absolute right-0 top-[-56px]"
            />

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
