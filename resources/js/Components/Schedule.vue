<script setup>
const props = defineProps({
    schedule: {
        type: String,
        required: true
    }
});

const schedule = props.schedule.split(';');
const formatted = {};

if (schedule.slice(0, 7).every(value => value === schedule[0])) {
    formatted['пн-нд'] = schedule[0];
} else if (schedule.slice(0, 5).every(value => value === schedule[0])) {
    formatted['пн-пт'] = schedule[0];

    if (schedule[5] == schedule[6]) {
        formatted['сб-нд'] = schedule[5];
    } else {
        formatted['сб'] = schedule[5];
        formatted['нд'] = schedule[6];
    }
} else {
    formatted['пн'] = schedule[0];
    formatted['вт'] = schedule[1];
    formatted['ср'] = schedule[2];
    formatted['чт'] = schedule[3];
    formatted['пт'] = schedule[4];
    formatted['сб'] = schedule[5];
    formatted['нд'] = schedule[6];
}

</script>

<template>
    <div
        v-for="(value, key) in formatted"
        :key="key"
        class="txt-h4 mb-2"
    >
        <div class="flex items-center gap-6">
            <div>{{ key }}</div>
            <div>{{ value === '' ? 'Вихідний' : value }}</div>
        </div>
    </div>
</template>
