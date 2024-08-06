<script setup>
import { MqResponsive } from "vue3-mq";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const expanded = ref(false);

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <header class="flex justify-between items-center px-16 py-10">
                <Link href="/">
                    <ApplicationLogo />
                </Link>

                <div v-if="$page.props.auth.user">
                    <nav class="flex gap-16 justify-between absolute left-2/4 top-16 translate-x-[-50%]">
                        <Link 
                            :href="route('home')"
                            :class="$page.url == '/' ? 'text-gray0' : 'text-gray40'"
                            class="font-semibold text-[22px] tracking-normal leading-none"
                        >
                            Головна
                        </Link>
                        <Link
                            v-if="$page.props.auth.user.userable_type == 'App\\Models\\Seeker'"
                            :href="route('vacancies')"
                            :class="$page.url.startsWith('/vacancies') ? 'text-gray0' : 'text-gray40'"
                            class="font-semibold text-[22px] tracking-normal leading-none"
                        >
                            Вакансії
                        </Link>
                        <Link
                            v-if="$page.props.auth.user.userable_type == 'App\\Models\\Saloon'"
                            :href="route('seekers')"
                            :class="$page.url.startsWith('/seekers') ? 'text-gray0' : 'text-gray40'"
                            class="font-semibold text-[22px] tracking-normal leading-none"
                        >
                            Кандидати
                        </Link>
                        <Link 
                            :href="route('chat')"
                            :class="$page.url.startsWith('/chat') ? 'text-gray0' : 'text-gray40'"
                            class="font-semibold text-[22px] tracking-normal leading-none"
                        >
                            Чати
                        </Link>
                    </nav>
                    <Link
                        :href="route('profile')"
                        class="flex items-center gap-4 px-6 py-2 rounded-xl bg-gray70"
                    >
                        <div class="txt-h5">{{ $page.props.auth.user.name }}</div>
                        <img :src="'/'+$page.props.auth.user.photo" class="w-14 h-14 rounded-[32px] bg-gray50">
                    </Link>
                </div>
                <div v-else class="flex items-center gap-6">
                    <Link :href="route('login')" class="font-semibold text-[20px]">
                        Увійти
                    </Link>
                    <Link :href="route('register')" class="font-semibold text-[20px] px-6 py-3 bg-gray60 rounded-xl">
                        Зареєструватися
                    </Link>
                </div>
            </header>
        </template>

        <template #mobile>
            <header class="relative flex justify-between items-center p-4">
                <Link href="/">
                    <div class="icon-mob-logo" />
                </Link>

                <div v-if="$page.props.auth.user">
                    <div 
                        @click="expanded = !expanded" 
                        :class="expanded ? 'icon-mob-nav-close' : 'icon-mob-nav'" 
                        />

                    <nav 
                        v-show="expanded"
                        class="z-10 absolute top-[72px] left-0 flex flex-col gap-10 w-full pt-4 pb-8 bg-background"
                    >
                        <Link 
                            :href="route('home')"
                            class="block text-center txt-buttons"
                        >
                            Головна
                        </Link>
                        <Link
                            v-if="$page.props.auth.user.userable_type == 'App\\Models\\Seeker'"
                            :href="route('vacancies')"
                            class="block text-center txt-buttons"
                        >
                            Вакансії
                        </Link>
                        <Link
                            v-if="$page.props.auth.user.userable_type == 'App\\Models\\Saloon'"
                            :href="route('seekers')"
                            class="block text-center txt-buttons"
                        >
                            Кандидати
                        </Link>
                        <Link 
                            :href="route('chat')"
                            class="block text-center txt-buttons"
                        >
                            Чати
                        </Link>
                        <Link 
                            :href="route('profile')"
                            class="block text-center txt-buttons"
                        >
                            Профіль
                        </Link>
                    </nav>
                </div>
                <div v-else class="flex items-center gap-1">
                    <Link :href="route('login')" class="py-1 px-[14px] txt-body">
                        Увійти
                    </Link>
                    <Link :href="route('register')" class="py-1 px-[14px] rounded bg-gray60 txt-body">
                        Зареєструватися
                    </Link>
                </div>
            </header>
        </template>
    </MqResponsive>
</template>
