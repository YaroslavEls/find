<script setup>
import InputLayout from '@/Layouts/InputLayout.vue';
import { ref } from 'vue';
import { useMq } from "vue3-mq";

defineProps({
    heading: { 
        type: String, 
        required: true
    },
    note: {
        type: String
    },
    error: { 
        type: String
    }
});

const model = defineModel({ 
    type: Array, 
    required: true 
});

const mq = useMq();

const options = ref({
    'Повна': false,
    'Неповна': false,
    'Підміни': false
});

for (let i = 0; i < model.value.length; i++) {
    if (model.value[i] in options.value) {
        options.value[model.value[i]] = true;
    }
}
const show = ref(false);

const update = (key) => {
    options.value[key] = !options.value[key];
    model.value.length = 0;
    for (let key in options.value) {
        if (options.value[key]) {
            model.value.push(key);
        }
    }
};

</script>

<template>
    <InputLayout>
        <template #heading>{{ heading }}</template>

        <template #default>
            <div 
                class="flex justify-between items-center px-3 mb-1 w-full bg-background border-solid rounded-lg txt-body"
                :class="[
                    error ? 'border-systemred' : 'border-gray40',
                    mq.desktop ? 'min-h-[61.2px] py-3 border-2' : 'py-[10px] border'
                ]"
            >
                <div class="flex flex-wrap gap-2">
                    <div
                        v-for="(value, key) in options"
                        :key="key"
                        v-show="value"
                        class="flex gap-1 px-2 py-1 rounded bg-gray60"
                        :class="mq.desktop ? 'h-8' : 'h-7'"
                    >
                        <div class="txt-body">{{ key }}</div>
                        <div @click="update(key)" class="icon-remove cursor-pointer" />
                    </div>
                </div>
                <div 
                    @click="show = !show" 
                    class="cursor-pointer" 
                    :class="show ? 'icon-collapse' : 'icon-expand'"
                />
            </div>
            <div 
                v-show="show" 
                class="absolute w-full border-solid border-gray40 rounded-lg bg-background z-10"
                :class="mq.desktop ? 'border-2' : 'border'"
            >
                <div
                    v-for="(value, key) in options"
                    :key="key"
                    @click="update(key)" 
                    class="flex justify-between p-4 cursor-pointer"
                >
                    <div class="txt-body">{{ key }}</div>
                    <div 
                        class="rounded"
                        :class="[
                            value ? 'icon-checkbox' : 'bg-gray50',
                            mq.desktop ? 'w-6 h-6' : 'w-5 h-5'    
                        ]"
                    />
                </div>
            </div>
        </template>
        
        <template v-if="note" #note>{{ note }}</template>
        <template v-if="error" #error>{{ error }}</template>
    </InputLayout>
</template>
