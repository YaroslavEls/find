<script setup>
defineProps({
    heading: {
        type: String,
        required: true
    },
    count: {
        type: Number,
        required: true
    }
});

</script>

<template>
    <div class="flex justify-between items-center mt-16 mb-14">
        <div class="flex items-end gap-4">
            <div class="txt-h1">{{ heading }}</div>
            <div class="text-gray40 txt-h3">{{ count }}</div>
        </div>

        <div class="flex gap-28">
            <div class="flex gap-2">
                <div class="px-6 py-2 h-fit bg-gray50 rounded txt-body">
                    Усі
                </div>
                <div class="px-6 py-2 h-fit bg-gray50 rounded txt-body">
                    Нові
                </div>
                <div class="flex gap-2 px-6 py-2 h-fit bg-gray50 rounded txt-body">
                    Обрані
                    <div class="icon-fav" />
                </div>
            </div>

            <div class="flex gap-2 px-6 py-2 h-fit bg-blue50 rounded txt-body">
                Фільтрувати
                <div class="icon-filter" />
            </div>
        </div>
    </div>
</template>
