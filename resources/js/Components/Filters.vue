<script setup>
import Checkbox from '@/Components/Filters/Checkbox.vue';
import Range from '@/Components/Filters/Range.vue';
import Text from '@/Components/Filters/Text.vue';
import SubmitButton from '@/Components/SubmitButton.vue';
import { router } from '@inertiajs/vue3'
import { ref } from 'vue';
import { useMq } from 'vue3-mq';

const props = defineProps({
    route: {
        type: String,
        required: true
    }
});

const model = defineModel({
    type: Boolean,
    required: true
});

const mq = useMq();

const searchParams = new URLSearchParams(window.location.search);

const filters = ref({
    job: {
        'Бариста': searchParams.get('job')
            ? searchParams.get('job').split(';').includes('Бариста') ?? false
            : false,
        'Старший Бариста': searchParams.get('job')
            ? searchParams.get('job').split(';').includes('Старший Бариста') ?? false
            : false
    },
    employment: {
        'Повна': searchParams.get('emp')
            ? searchParams.get('emp').split(';').includes('Повна') ?? false
            : false,
        'Неповна': searchParams.get('emp')
            ? searchParams.get('emp').split(';').includes('Неповна') ?? false
            : false,
        'Підміни': searchParams.get('emp') ? 
            searchParams.get('emp').split(';').includes('Підміни') ?? false
            : false
    },
    experience: searchParams.get('exp') ?? 0,
    salary: searchParams.get('sal') ?? '',
    city: searchParams.get('city') ?? ''
});

const nonEmpty = (obj) => {
    return Object.fromEntries(Object.entries(obj).filter(([_, value]) => {
        if (value === '') {
            return false;
        }
        return true;
    }));
};

const params = () => {
    const params = {
        saloon: searchParams.get('saloon') ?? '',
        sort: searchParams.get('sort') ?? '',
        job: '',
        emp: '',
        exp: filters.value.experience > 0 ? filters.value.experience : '',
        sal: filters.value.salary,
        city: filters.value.city
    };

    let tmp = [];
    Object.entries(filters.value.job).forEach(([key, value]) => {
        if (value) {
            tmp.push(key);
        }
    });
    params['job'] = tmp.join(';');
    tmp = [];
    Object.entries(filters.value.employment).forEach(([key, value]) => {
        if (value) {
            tmp.push(key);
        }
    });
    params['emp'] = tmp.join(';');

    return nonEmpty(params);
};

const filter = () => {
    router.visit(route(props.route, params()), {
        preserveState: true,
        onSuccess: () => model.value = !model.value
    });
};

</script>

<template>
    <div 
        class="absolute right-0 z-10 border-solid border border-gray40 rounded-lg bg-gray70"
        :class="mq.desktop ? 'top-16 w-[420px] p-6' : 'top-[90px] w-full p-4'"
    >
        <div class="flex justify-between items-center mb-8">
            <div class="txt-h4">Фільтри</div>
            <div
                @click="model = !model"
                class="icon-close cursor-pointer" 
            />
        </div>
        <div class="mb-2 text-gray30 txt-h5">Вакансія</div>
        <Checkbox
            v-for="(_, key) in filters.job"
            :key="key"
            :text="key"
            v-model="filters.job[key]"
        />
        <div class="mt-8 mb-2 text-gray30 txt-h5">Тип зайнятості</div>
        <Checkbox
            v-for="(_, key) in filters.employment"
            :key="key"
            :text="key"
            v-model="filters.employment[key]"
        />
        <div class="flex justify-between items-center mt-8 text-gray30">
            <div class="txt-h5">Мінімальний досвід</div>
            <div class="txt-secondary">{{ (filters.experience == 6.5 ? '6+' : filters.experience) }} років</div>
        </div>
        <Range
            v-model="filters.experience"
        />
        <div class="mt-8 mb-2 text-gray30 txt-h5">Мінімальна зарплата</div>
        <Text
            type="number"
            placeholder="20000"
            v-model="filters.salary"
        />
        <div class="mt-8 mb-2 text-gray30 txt-h5">Місто</div>
        <Text
            placeholder="Київ"
            v-model="filters.city"
        />
        <SubmitButton
            @click="filter"
            text="Шукати за фільтрами"
            regular
            class="mt-8"
        />
    </div>
</template>
