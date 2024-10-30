<script setup>
import Confirm from '@/Components/Modals/Confirm.vue';
import { ref } from 'vue';

const modal = ref(null);

const show = () => {
    document.documentElement.style.overflow = 'hidden';
    modal.value = route('profile.delete');
};

</script>

<template>
    <div>
        <div 
            @click="show" 
            class="flex gap-2 justify-center items-center mt-14 text-systemred txt-text-buttons cursor-pointer"
        >
            <div>Видалити акаунт</div>
            <div class="icon-delete red" />
        </div>

        <Confirm
            title="Видалити профіль?"
            subtitle="Видалений профіль неможливо буде відновити. Всі локації та вакансії пов'язані з Вашим закладом також будут видалені. Ви впевнені що бажаєте видалити профіль?"
            password
            v-show="modal"
            v-model="modal"
        />
    </div>
</template>
