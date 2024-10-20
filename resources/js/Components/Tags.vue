<script setup>
import { useMq } from "vue3-mq";

const props = defineProps({
    tags: {
        type: Object,
        required: true
    }
});

const mq = useMq();

const transformed = {
    date: null,
    experience: null,
    employment: null,
    replacement: null
}

const date = new Date(props.tags.date);
const formatter = new Intl.DateTimeFormat('uk-UA', { 
    day: 'numeric', 
    month: 'long' 
});
transformed.date = formatter.format(date);

switch (props.tags.exp) {
    case '0':
        transformed.experience = 'Без досвіду';
        break;
    case '1':
        transformed.experience = props.tags.exp + ' рік досвіду';
        break;
    case '2':
    case '3':
    case '4':
        transformed.experience = props.tags.exp + ' роки досвіду';
        break;
    case '6.5':
        transformed.experience = '6+ років досвіду';
        break;
    default:
        transformed.experience = props.tags.exp + ' років досвіду';
}

const empl = props.tags.empl.split(';');

if (empl.includes('Повна') && empl.includes('Неповна')) {
    transformed.employment = 'Повна/Неповна зайнятість'
} else if (empl.includes('Повна') && !empl.includes('Неповна')) {
    transformed.employment = 'Повна зайнятість'
} else if (!empl.includes('Повна') && empl.includes('Неповна')) {
    transformed.employment = 'Неповна зайнятість'
}

transformed.replacement = empl.includes('Підміни') ? 'Підміни' : null;

const icons = {
    date: 'icon-date',
    experience: 'icon-experience',
    employment: 'icon-employment',
    replacement: 'icon-replacement'
};

const iconsMob = {
    date: 'icon-date',
    experience: 'icon-experience',
    employment: 'icon-employment',
    replacement: 'icon-replacement'
};

</script>

<template>
    <div class="flex flex-wrap gap-2">
        <div 
            v-for="(value, key) in transformed"
            :key="key"
            v-show="value !== null"
            class="flex items-center py-1 h-fit rounded bg-gray70 txt-secondary"
            :class="mq.desktop ? 'gap-2 px-4' : 'gap-1 px-2'"
        >
            <div :class="icons[key]"></div>
            {{ value }}
        </div>
    </div>
</template>
