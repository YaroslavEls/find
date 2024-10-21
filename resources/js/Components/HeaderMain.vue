<script setup>
import { MqResponsive } from "vue3-mq";
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const expanded = ref(false);

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <header class="max-w-[1840px] w-full px-6 flex justify-between items-center py-10 mx-auto">
                <Link href="/"><div class="icon-logo" /></Link>

                <div v-if="$page.props.auth.user">
                    <div v-if="$page.props.auth.user.userable_id">
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
                                <div 
                                    v-if="$page.props.auth.user.new_messages.length > 0"
                                    class="absolute top-[-4px] right-[-12px] w-4 h-4 bg-systemred rounded-full"
                                />
                            </Link>
                        </nav>
                        <Link
                            :href="route('profile')"
                            class="flex items-center gap-4 px-6 py-2 rounded-xl bg-gray70"
                        >
                            <div class="max-w-[300px] crop crop-1 txt-h5">{{ $page.props.auth.user.name }}</div>
                            <div
                                class="w-14 h-14 rounded-[32px] bg-gray50 image"
                                :style="{ backgroundImage: `url('/${$page.props.auth.user.photo}')` }"
                            />
                        </Link>
                    </div>
                    <div v-else class="flex items-center gap-6">
                        <Link :href="route('logout')" method="post" as="button" class="font-semibold text-[20px] px-6 py-[10px] rounded-xl border-gray50 border-2">
                            Вийти
                        </Link>
                        <Link :href="route('profile')" class="font-semibold text-[20px] px-6 py-[10px] rounded-xl border-gray50 border-2">
                            Продовжити реєстрацію
                        </Link>
                    </div>
                </div>
                <div v-else class="flex items-center gap-6">
                    <Link :href="route('login')" class="font-semibold text-[20px] px-6 py-[10px] rounded-xl border-gray50 border-2">
                        Увійти
                    </Link>
                    <Link :href="route('register')" class="font-semibold text-[20px] px-6 py-[10px] rounded-xl border-gray50 border-2">
                        Зареєструватися
                    </Link>
                </div>
            </header>
        </template>

        <template #mobile>
            <header class="relative flex justify-between items-center p-4">
                <Link href="/">
                    <div class="icon-logo" />
                </Link>

                <div v-if="$page.props.auth.user">
                    <div v-if="$page.props.auth.user.userable_id">
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
                                class="relative block text-center txt-buttons"
                            >
                                Чати
                                <div 
                                    v-if="$page.props.auth.user.new_messages.length > 0"
                                    class="absolute top-0 left-1/2 transform -translate-x-1/2 ml-[22px] w-3 h-3 bg-systemred rounded-full"
                                />
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
                        <Link :href="route('logout')" method="post" as="button" class="py-1 px-[14px] py-1 rounded border border-gray60 txt-body">
                            Вийти
                        </Link>
                        <Link :href="route('profile')" class="py-1 px-[14px] py-1 rounded border border-gray60 txt-body">
                            Продовжити
                        </Link>
                    </div>
                </div>
                <div v-else class="flex items-center gap-1">
                    <Link :href="route('login')" class="py-1 px-[14px] py-1 rounded border border-gray60 txt-body">
                        Увійти
                    </Link>
                    <Link :href="route('register')" class="py-1 px-[14px] py-1 rounded border border-gray60 txt-body">
                        Зареєструватися
                    </Link>
                </div>
            </header>
        </template>
    </MqResponsive>
</template>
