<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
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
                    v-show="$page.props.auth.user.userable_type == 'App\\Models\\Seeker'"
                    :href="route('vacancies')"
                    :class="$page.url.split('/')[1] == 'vacancies' ? 'text-gray0' : 'text-gray40'"
                    class="font-semibold text-[22px] tracking-normal leading-none"
                >
                    Вакансії
                </Link>
                <Link
                    v-show="$page.props.auth.user.userable_type == 'App\\Models\\Saloon'"
                    :href="route('seekers')"
                    :class="$page.url.split('/')[1] == 'seekers' ? 'text-gray0' : 'text-gray40'"
                    class="font-semibold text-[22px] tracking-normal leading-none"
                >
                    Кандидати
                </Link>
                <Link 
                    :href="route('home')"
                    :class="$page.url == '/chat' ? 'text-gray0' : 'text-gray40'"
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

    <main>
        <slot />
    </main>

    <footer class="border-solid border-t-2 border-gray50">
        <div class="max-w-[1488px] w-full mx-auto py-8">
            <div>
                <Link href="/">
                    <ApplicationLogo />
                </Link>
                <div class="flex items-center gap-2 mt-6">
                    <div class="txt-body">Зроблено в Україні!</div>
                    <svg width="40" height="26" viewBox="0 0 40 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_619_3562)">
                            <rect width="40" height="13" fill="#005EC7"/>
                            <rect y="13" width="40" height="13" fill="#FFD232"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_619_3562">
                                <rect width="40" height="26" rx="4" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
            </div>
        </div>
    </footer>
</template>
