<script setup>
const props = defineProps({
    tags: {
        type: Object,
        required: true
    }
});

const transformed = {
    date: null,
    experience: null,
    employment: null
}

const date = new Date(props.tags.date);
const months = [
    'Січня', 'Лютого', 'Березня', 'Квітня', 'Травня', 'Червня',
    'Липня', 'Серпня', 'Вересня', 'Жовтня', 'Листопада', 'Грудня'
];
transformed.date = date.getDate() + ' ' + months[date.getMonth()];

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

transformed.employment = props.tags.empl.split(';')[0] + ' зайнятість';

const icons = {
    date: 'icon-date',
    experience: 'icon-experience',
    employment: 'icon-employment'
}

</script>

<template>
    <div class="flex gap-2">
        <div 
            v-for="(value, key) in transformed"
            :key="key"
            class="flex items-center gap-2 px-4 py-1 h-fit rounded bg-gray60 txt-secondary"
        >
            <div :class="icons[key]"></div>
            {{ value }}
        </div>
    </div>
</template>
