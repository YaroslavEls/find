<script setup>
const back = () => {
    window.history.back();
};

</script>

<template>
    <div
        @click="back"
        class="flex items-center gap-2 w-fit mb-6 text-blue30 txt-buttons cursor-pointer"
    >
        <div class="icon-back" /> Назад
    </div>
</template>
