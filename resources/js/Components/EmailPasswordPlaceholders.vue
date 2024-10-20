<script setup>
import UpdatePassword from '@/Components/Modals/UpdatePassword.vue';
import { useMq } from 'vue3-mq';
import { ref } from 'vue';

defineProps({
    email: { 
        type: String,
        required: true 
    }
});

const mq = useMq();

const modal = ref(false);

const show = () => {
    document.documentElement.style.overflow = 'hidden';
    modal.value = true;
};

</script>

<template>
    <div class="mb-1 txt-h5">Ел. пошта</div>
    <div 
        class="mb-8 p-4 w-full bg-background border-solid border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body"
        :class="mq.desktop ? 'border-2' : 'border'"
    >
        {{ email }}
    </div>
    <div class="mb-1 txt-h5">Пароль</div>
    <div 
        class="mb-2 p-4 w-full bg-background border-solid border-gray40 rounded-lg text-gray0 cursor-not-allowed txt-body"
        :class="mq.desktop ? 'border-2' : 'border'"
    >
        ********
    </div>
    <div @click="show" class="block w-fit ml-auto mr-0 mb-10 text-blue40 text-right txt-text-buttons cursor-pointer">
        Змінити пароль
    </div>
    <UpdatePassword
        v-show="modal"
        v-model="modal"
    />
</template>
