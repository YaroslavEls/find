<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { onMounted, ref } from 'vue';

defineProps({
    type: {
        type: String,
        required: true
    },
    heading: {
        type: String,
        required: true
    },
    error: {
        type: String
    }
});

const model = defineModel({
    type: Array,
    required: true
});

const sameInput = ref(null);

const mode = ref(true);

const days = ['Понеділок', 'Вівторок', 'Середа', 'Четвер', 'П\'ятниця', 'Субота', 'Неділя'];

const fill = (e) => {
    model.value = model.value.map(() => e.target.value);
};

onMounted(() => {
    if (model.value.every(x => x == model.value[0])) {
        mode.value = false;
        sameInput.value.value = model.value[0];
    }
});

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>
        <template #subheading>
            <div
                @click="mode = !mode"
                class="flex items-center gap-2 text-blue40 txt-text-buttons cursor-pointer"
            >
                {{ mode ? 'Однаковий графік' : 'Різний графік' }}
                <div class="icon-schedule"></div>
            </div>
        </template>

        <template #default>
            <input
                ref="sameInput"
                v-show="!mode"
                :type="type"
                placeholder="07:00 - 20:00"
                @input="fill($event)"
                class="p-4 w-full bg-background border-solid border-2 rounded-lg text-gray0 txt-body"
                :class="error ? 'border-systemred' : 'border-gray40'"
            >

            <div v-show="mode">
                <div class="mb-4 mt-2 text-gray30 txt-secondary">
                    Якщо якийсь з днів вихідний, просто залиште поле вводу пустим!
                </div>
                <div
                    v-for="(value, index) in days"
                    :key="index"
                    class="flex justify-between items-center mb-4"
                >
                    <div class="text-gray40 txt-h5">{{ value }}</div>
                    <input 
                        type="text"
                        placeholder="07:00 - 20:00"
                        v-model="model[index]"
                        class="w-[272px] text-center py-4 border-solid border-2 border-gray40 rounded-lg bg-background txt-body"
                    >
                </div>
            </div>

        </template>
        
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
