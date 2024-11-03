<script setup>
import { MqResponsive } from "vue3-mq";
import { Link } from '@inertiajs/vue3';

const scrollTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <footer class="border-solid border-t-2 border-gray50 px-6 py-8">
                <div class="flex justify-between gap-36 max-w-[1512px] w-full mx-auto mb-16">
                    <Link href="/" class="w-fit">
                        <div class="icon-logo" />
                    </Link>
                    <div class="flex justify-between gap-8 max-w-[600px] w-full mt-4">
                        <div>
                            <div class="mb-4 txt-h5">Корисні</div>
                            <Link
                                :href="route('home')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Головна
                            </Link>
                            <Link
                                v-if="$page.component !== 'Error' && (!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Seeker')"
                                :href="route('vacancies')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Вакансії
                            </Link>
                            <Link
                                v-if="$page.component !== 'Error' && (!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Saloon')"
                                :href="route('seekers')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Кандидати
                            </Link>
                            <Link
                                :href="route('chat')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Чати
                            </Link>
                            <Link
                                v-if="$page.component !== 'Error' && (!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Saloon')"
                                :href="route('vacancies')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Вакансії
                            </Link>
                        </div>
                        <div>
                            <div class="mb-4 txt-h5">Соціальні мережі</div>
                            <a 
                                href="https://t.me/FINDofficialua"
                                target="_blank"
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Telegram
                            </a>
                            <a 
                                href="https://www.instagram.com/find.platform/" 
                                target="_blank" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Instagram
                            </a>
                        </div>
                        <div>
                            <div class="mb-4 txt-h5">Контакти</div>
                            <a 
                                href="mailto:Find.help.ua@gmail.com"
                                target="_blank"
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Email
                            </a>
                        </div>
                    </div>
                    <div
                        @click="scrollTop"
                        class="mt-4 text-blue40 txt-buttons cursor-pointer"
                    >
                        Повернутися вгору!
                    </div>
                </div>

                <div class="flex justify-between max-w-[1512px] w-full mx-auto">
                    <div class="flex items-center gap-2">
                        <div class="txt-body">Зроблено в Україні!</div>
                        <div class="icon-flag" />
                    </div>

                    <div class="txt-body">Designed & Developed by S.Wagoon Agency © 2024</div>
                </div>
            </footer>
        </template>

        <template #mobile>
            <footer class="px-4 pt-6 pb-12 border-t-2 border-gray50">
                <div class="flex justify-between items-center mb-14">
                    <Link href="/">
                        <div class="icon-logo" />
                    </Link>
                    <div @click="scrollTop" class="text-blue40 txt-text-buttons">Повернутися вгору</div>
                </div>

                <div class="flex gap-x-20 gap-y-12 flex-wrap mb-14">
                        <div>
                            <div class="mb-4 txt-h5">Корисні</div>
                            <Link
                                :href="route('home')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Головна
                            </Link>
                            <Link
                                v-if="!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Seeker'"
                                :href="route('vacancies')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Вакансії
                            </Link>
                            <Link
                                v-if="!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Saloon'"
                                :href="route('seekers')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Кандидати
                            </Link>
                            <Link
                                :href="route('chat')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Чати
                            </Link>
                            <Link
                                v-if="!$page.props.auth.user || $page.props.auth.user.userable_type == 'App\\Models\\Saloon'"
                                :href="route('vacancies')" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Вакансії
                            </Link>
                        </div>
                        <div>
                            <div class="mb-4 txt-h5">Соціальні мережі</div>
                            <a 
                                href="https://t.me/FINDofficialua"
                                target="_blank"
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Telegram
                            </a>
                            <a 
                                href="https://www.instagram.com/find.platform/" 
                                target="_blank" 
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Instagram
                            </a>
                        </div>
                        <div>
                            <div class="mb-4 txt-h5">Контакти</div>
                            <a 
                                href="mailto:Find.help.ua@gmail.com"
                                target="_blank"
                                class="block mb-2 text-gray40 txt-buttons"
                            >
                                Email
                            </a>
                        </div>
                    </div>

                <div class="flex items-center gap-1 mb-6 txt-body">
                    Зроблено в Україні!
                    <div class="icon-flag" />
                </div>
                <div class="txt-body">Designed & Developed by S.Wagoon Agency © 2024</div>
            </footer>
        </template>
    </MqResponsive>
</template>
