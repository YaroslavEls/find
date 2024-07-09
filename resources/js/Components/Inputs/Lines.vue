<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';

const props = defineProps({
    heading: {
        type: String
    },
    error: {
        type: Object,
        required: true
    }
});

const model = defineModel({
    type: Array,
    required: true
});

const errors = () => {
    return Object
        .keys(props.error)
        .filter(key => key.startsWith('socials'))
        .map(key => +key.split(".")[1]);
};

</script>

<template>
    <InputLayout>
        <template v-if="heading" #heading>{{ heading }}</template>

        <template #default>
            <div
                v-for="(link, index) in model"
                :key="index"
                class="relative"
            >
                <input
                    type="text"
                    placeholder="https://"
                    v-model="model[index]" 
                    class="pl-4 pr-14 py-4 w-full bg-background border-solid border-2 rounded-lg text-gray0 txt-body"
                    :class="errors().includes(index) ? 'mb-1 border-systemred' : 'mb-4 border-gray40'"
                >
                <div
                    v-show="index != 0"
                    @click="model.splice(index, 1)" 
                    class="icon-delete absolute top-[18px] right-4 cursor-pointer"
                />
                <div
                    v-show="errors().includes(index)"
                    class="mb-4 text-systemred txt-secondary"
                >
                    {{ error[`socials.${index}`] }}
                </div>
            </div>

            <div
                v-show="model.length < 5"
                @click="model.push('')" 
                class="flex justify-center items-center gap-2 text-blue40 text-center cursor-pointer txt-text-buttons"
            >
                Додати ще посилання
                <div class="icon-add"></div>
            </div>
        </template>

        <template v-if="errors().length" #error>{{ error['socials'] }}</template>
    </InputLayout>
</template>
