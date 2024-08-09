<script setup>
import AuthLayout from '@/Layouts/AuthLayout.vue';
import ProgressBar from '@/Components/ProgressBar.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import RegForm1 from '@/Pages/Seeker/Partials/RegForm1.vue';
import RegForm2 from '@/Pages/Seeker/Partials/RegForm2.vue';
import RegForm3 from '@/Pages/Seeker/Partials/RegForm3.vue';
import RegForm4 from '@/Pages/Seeker/Partials/RegForm4.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const tabs = [RegForm1, RegForm2, RegForm3, RegForm4];
const current = ref(0);

const forms = [
    useForm({
        name: null,
        birthday: null,
        photo: null
    }),
    useForm({
        job: 'Бариста',
        experience: 1,
        salary: null
    }),
    useForm({
        city: 'Київ',
        employment: ['Повна', 'Неповна', 'Підміни']
    }),
    useForm({
        info: null,
        cv: null
    }),
];

const move = (num) => {
    return Math.min(Math.max(num, 0), 3);
};

const next = () => {
    forms[current.value].post(route('seeker.validate'), {
        headers: {
            'form-page': current.value
        },
        onError: () => {
            console.log(forms);
        },
        onSuccess: () => {
            if (current.value < 3) {
                current.value = move(++current.value);
                return;
            }
            const form = useForm({
                ...forms[0].data(),
                ...forms[1].data(),
                ...forms[2].data(),
                ...forms[3].data()
            });
            form.post(route('register.seeker'));
        }
    });
};

const isFilled = (form) => {
    const data = form.data();
    if (data.hasOwnProperty('cv')) delete data['cv'];

    const values = Object.values(data);
    for (let i = 0; i < values.length; i++) {
        if (values[i] === null || values[i] === '') return false;
    }
    return true;
};

const allow = computed(() => {
    return [
        isFilled(forms[0]),
        isFilled(forms[1]),
        isFilled(forms[2]),
        isFilled(forms[3]),
    ];
});

</script>

<template>
    <Head title="Реєстрація Кандидата" />

    <AuthLayout>
        <div class="w-full">
            <div
                @click="current = move(--current)"
                :class="{ 'invisible': current == 0 }"
                class="flex items-center gap-2 w-fit mb-6 text-blue30 txt-buttons cursor-pointer"
            >
                <div class="icon-back" /> Назад
            </div>

            <ProgressBar
                heading="Реєстрація"
                steps="4"
                :current="current"
            />

            <form @submit.prevent="next" class="flex flex-col min-h-[440px]">
                <component
                    :is="tabs[current]"
                    v-model="forms[current]"
                />
                <SubmitButton 
                    :text="current == 3 ? 'Почати пошук' : 'Продовжити'"
                    class="mt-auto"
                    :class="allow[current] ? 'bg-blue50' : 'bg-gray70 text-gray40 pointer-events-none'"
                />
            </form>
        </div>
    </AuthLayout>
</template>
