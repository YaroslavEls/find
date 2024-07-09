<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref } from 'vue';

defineProps({
    identifier: {
        type: String,
        required: true
    },
    heading: {
        type: String,
        required: true
    },
    subheading: {
        type: String,
        required: true
    },
    button: {
        type: String,
        required: true
    },
    error: {
        type: String
    }
});

const photos = defineModel('photos', { 
    type: Array,
    required: true 
});

const oldPhotos = defineModel('oldPhotos', { 
    type: Array,
    required: false,
    default: [] 
});

const urls = ref([]);

const count = () => {
    return urls.value.length + oldPhotos.value.length;
};

const inputEvent = (e) => {
    for (let i = 0; i < e.target.files.length; i++) {
        if (urls.value.length + oldPhotos.value.length === 12) {
            return;
        }
        const file = e.target.files[i];
        urls.value.push(URL.createObjectURL(file));
        photos.value.push(file);
    }
};

const remove = (x) => {
    console.log(x);
    urls.value.splice(x, 1);
    photos.value.splice(x, 1);
};

const removeOld = (x) => {
    oldPhotos.value.splice(x, 1);
};

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>
        <template #subheading>{{ subheading }}</template>

        <template #default>
            <label
                v-show="count() == 0"
                :for="identifier" 
                class="block py-[15px] w-full bg-background border-solid border-2 border-gray40 rounded-lg text-gray0 txt-buttons text-center cursor-pointer"
            >
                {{ button }}
            </label>

            <input
                :id="identifier"
                type="file"
                accept=".png,.jpg"
                @input="inputEvent"
                class="txt-secondary"
                multiple
            >

            <div v-show="count() > 0" class="flex flex-wrap gap-x-8 gap-y-4">
                <div
                    v-for="(item, index) in oldPhotos"
                    :key="item"
                    @click="removeOld(index)"
                    class="relative"
                >
                    <img 
                        :src="'/' + item" 
                        class="w-[120px] h-[88px] bg-gray0 rounded"
                    >
                    <div class="absolute opacity-0 flex justify-center items-center gap-1 w-full h-full top-0 bg-[#000] bg-opacity-50 border-solid border-2 border-gray0 rounded txt-secondary cursor-pointer hover:opacity-100">
                        Видалити
                        <div class="icon-delete" />
                    </div>
                </div>
                
                <div
                    v-for="(url, index) in urls"
                    :key="url"
                    @click="remove(index)"
                    class="relative"
                >
                    <img
                        :src="url"
                        class="w-[120px] h-[88px] bg-gray0 rounded"
                    >
                    <div class="absolute opacity-0 flex justify-center items-center gap-1 w-full h-full top-0 bg-[#000] bg-opacity-50 border-solid border-2 border-gray0 rounded txt-secondary cursor-pointer hover:opacity-100">
                        Видалити
                        <div class="icon-delete" />
                    </div>
                </div>

                <label
                    v-show="count() > 0 && count() < 12"
                    :for="identifier"
                    class="w-[120px] h-[88px] border-solid border-gray40 border-2 rounded cursor-pointer icon-add bg-no-repeat bg-center"
                />
            </div>
        </template>

        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
