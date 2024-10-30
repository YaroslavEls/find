<script setup>
import { MqResponsive } from 'vue3-mq';
import Text from '@/Components/Inputs/Text.vue';
import { useForm } from '@inertiajs/vue3';

const model = defineModel({
    type: Boolean,
    required: true
});

const form = useForm({
    current_password: '',
    password: ''
});

const close = () => {
    form.errors = [];
    form.reset();
    document.documentElement.style.overflow = 'auto';
    model.value = false;
};

const submit = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onError: () => {
            form.reset()
        },
        onSuccess: () => {
            close();
            window.scrollTo(0, 0);
        }
    });
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div @click.self="close" class="fixed top-0 left-0 w-full h-full bg-background-dim z-10">
                <form
                    @submit.prevent="submit"
                    class="relative top-2/4 left-2/4 translate-x-[-50%] translate-y-[-50%] w-[880px] px-[152px] py-[72px] rounded-3xl bg-background border-solid border-gray40 border-4"
                >
                    <div class="mb-10 txt-h1">Зміна пароля</div>
                    <Text
                        type="password"
                        placeholder="********"
                        heading="Поточний пароль"
                        :error="form.errors.current_password"
                        v-model="form.current_password"
                    />
                    <Text
                        type="password"
                        placeholder="********"
                        heading="Новий пароль"
                        class="mb-[80px]"
                        :error="form.errors.password"
                        v-model="form.password"
                    />
                    <div
                        @click="close"
                        class="w-full mb-6 py-4 text-center border-solid border-2 border-gray40 rounded-lg txt-buttons cursor-pointer"
                    >
                        Скасувати
                    </div>
                    <button
                        class="w-full py-4 text-center border-solid border-2 border-gray40 rounded-lg txt-buttons cursor-pointer"
                        :class="(form.current_password && form.password) ? '' : 'pointer-events-none opacity-40'"
                    >
                        Підтвердити
                    </button>
                </form>
            </div>
        </template>

        <template #mobile>
            <form 
                @submit.prevent="submit"
                class="fixed top-0 left-0 w-full h-full bg-background z-10 pt-10 px-4"
            >
                <div
                    @click="close"
                    class="flex items-center gap-2 w-fit mb-6 text-blue30 txt-text-buttons"
                >
                    <div class="icon-back" /> Назад
                </div>
                <div class="mb-10 txt-h1">Зміна пароля</div>
                <Text
                    type="password"
                    placeholder="********"
                    heading="Поточний пароль"
                    :error="form.errors.current_password"
                    v-model="form.current_password"
                />
                <Text
                    type="password"
                    placeholder="********"
                    heading="Новий пароль"
                    class="mb-[64px]"
                    :error="form.errors.password"
                    v-model="form.password"
                    />
                <div
                    @click="close"
                    class="w-full mb-6 py-3 text-center border-solid border border-gray40 rounded-lg txt-buttons"
                >
                    Скасувати
                </div>
                <button
                    class="w-full py-3 text-center border-solid border border-gray40 rounded-lg txt-buttons"
                    :class="(form.current_password && form.password) ? '' : 'pointer-events-none opacity-40'"
                >
                    Підтвердити
                </button>
            </form>
        </template>
    </MqResponsive>
</template>
