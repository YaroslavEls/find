<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ProgressBar from '@/Components/ProgressBar.vue';
import RegForm1 from '@/Pages/Saloon/Partials/RegForm1.vue';
import RegForm2 from '@/Pages/Saloon/Partials/RegForm2.vue';
import RegForm3 from '@/Pages/Saloon/Partials/RegForm3.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const tabs = [RegForm1, RegForm2, RegForm3];
const current = ref(0);

const form = useForm({
    name: null,
    descr: null,
    logo: null,
    socials: [''],
    locations: ref([])
});

</script>

<template>
    <MainLayout>
        <Head title="Register" />

        <div class="w-[576px] mt-6 mb-32 mx-auto">
            <div
                @click="current = --current"
                :class="{ 'invisible': current == 0 }"
                class="flex items-center gap-2 w-fit mb-6 text-blue30 txt-buttons cursor-pointer"
            >
                <div class="icon-back" /> Назад
            </div>

            <ProgressBar
                :heading="current < 2 ? 'Реєстрація' : 'Додавання локації'"
                steps="2"
                :current="current"
            />

            <component
                :is="tabs[current]"
                v-model="form"
                v-model:current="current"
            />
        </div>
    </MainLayout>  
</template>
