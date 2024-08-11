<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import ProgressBar from '@/Components/ProgressBar.vue';
import RegForm1 from '@/Pages/Saloon/Partials/RegForm1.vue';
import RegForm2 from '@/Pages/Saloon/Partials/RegForm2.vue';
import RegForm3 from '@/Pages/Saloon/Partials/RegForm3.vue';
import RegForm4 from '@/Pages/Saloon/Partials/RegForm4.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const current = ref(0);
const toEdit = ref(null);

const heading = computed(() => {
    return current.value < 2 
        ? 'Реєстрація' 
        : current.value === 2 
            ? 'Додавання локації' 
            : 'Редагування локації';
});

const form = useForm({
    name: null,
    descr: null,
    logo: null,
    socials: [''],
    locations: []
});

</script>

<template>
    <Head title="Реєстрація Закладу" />

    <AuthLayout>
        <div class="w-full">
            <div
                @click="current = (current === 3 ? 1 : --current)"
                :class="{ 'invisible': current == 0 }"
                class="flex items-center gap-2 w-fit mb-6 text-blue30 txt-buttons cursor-pointer"
            >
                <div class="icon-back" /> Назад
            </div>

            <ProgressBar
                :heading="heading"
                steps="2"
                :current="current"
            />

            <RegForm1
                v-if="current === 0"
                v-model="form"
                v-model:current="current"
            />
            <RegForm2
                v-if="current === 1"
                v-model="form"
                v-model:current="current"
                v-model:toEdit="toEdit"
            />
            <RegForm3
                v-if="current === 2"
                v-model="form"
                v-model:current="current"
            />
            <RegForm4
                v-if="current === 3"
                v-model="form"
                v-model:current="current"
                v-model:toEdit="toEdit"
            />
        </div>
    </AuthLayout>  
</template>
