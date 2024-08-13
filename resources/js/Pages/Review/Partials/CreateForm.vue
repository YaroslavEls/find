<script setup>
import { MqResponsive } from "vue3-mq";
import Stars from '@/Components/Inputs/Stars.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { ref } from 'vue';

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
const stars = [ref(null), ref(null), ref(null), ref(null), ref(null)];

const resize = () => {
    const posY = window.scrollY;
    textarea.value.style.height = 'auto';
    textarea.value.style.height = (textarea.value.scrollHeight + 5) + 'px';
    window.scrollTo(0, posY);
};

model.value.regenerate = () => {
    model.value.reset();
    textarea.value.style.height = 'auto';
    for (let i = 0; i < stars.length; i++) {
        stars[i].value[0].classList.add('gray');
    }
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="flex gap-[3%]">
                <div class="relative basis-[69%]">
                    <Stars
                        :stars="stars"
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

        <template #mobile>
            <div>
                <div class="flex justify-between items-end mb-3">
                    <div class="text-gray40 txt-h3">Залишити відгук</div>
                    <Stars
                        :stars="stars"
                        v-model="model.score"
                    />
                </div>
                <div class="flex gap-2">
                    <textarea
                        rows="1"
                        placeholder="Напишіть свій відгук"
                        ref="textarea"
                        @input="resize"
                        v-model="model.text"
                        class="w-full max-h-[500px] px-4 py-3 bg-background border-solid border-2 border-gray40 rounded-lg text-gray0 txt-body"
                    ></textarea>
                    <button
                        class="max-w-12 w-full h-12 rounded-lg bg-center bg-no-repeat bg-blue50 icon-send" 
                    />
                </div>
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
        </template>
    </MqResponsive>
</template>
