<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const start = !usePage().props.auth.user
    ? route('login')
    : usePage().props.auth.user.userable_type === 'App\\Models\\Seeker'
        ? route('vacancies')
        : route('seekers');

const scrollToDetails = (pos) => {
    window.scrollTo({
        top: pos,
        behavior: 'smooth'
    });
};

</script>

<template>
    <Head title="Головна" />
    
    <MainLayout>
        <MqResponsive group>
            <template #desktop>
                <div class="max-w-[1488px] mx-auto pb-16">
                    <div class="flex justify-between mb-4">
                        <div class="w-fit px-6 py-3 bg-blue50 rounded-lg txt-h5">Платформа для пошуку роботи</div>
                        <div class="w-fit px-6 py-3 bg-blue50 rounded-lg txt-h5">Кав’ярні обирають FIND</div>
                    </div>
                    <div class="max-w-[1032px] font-semibold text-[80px] leading-[110%] mb-4">FIND - шукай роботу, якісно, швидко та зручно</div>
                    <div class="max-w-[728px] mb-16 text-gray30 txt-h3">Місце, для пошуку роботи та кандидатів в сфері загального харчування</div>
                    <div class="flex gap-8 justify-end">
                        <div
                            @click="scrollToDetails(775)"
                            class="text-center w-[424px] py-[18px] border-solid border-2 border-gray40 rounded-lg txt-buttons cursor-pointer"
                        >
                            Дізнатися більше
                        </div>
                        <Link
                            :href="start"
                            class="text-center w-[424px] rounded-lg py-5 bg-blue50 txt-buttons"
                        >
                            Почати пошук
                        </Link>
                    </div>
                </div>

                <div id="details-desk" class="my-16 py-12 px-16 rounded-[32px] bg-gray80 scroll-smooth scroll-mt-8">
                    <div class="max-w-[1488px] mx-auto">
                        <div class="flex gap-2 w-fit px-6 mb-6 py-3 rounded-lg bg-blue50">
                            <div class="icon-idea" />
                            <div class="txt-h2">Ідея</div>
                        </div>
                        <div class="txt-h4">
                            Працюючи в цій сфері, ми постійно стикались із задачею пошуку кваліфікованих бариста. І коли, знаходили - то, дізнавались, що вони також шукають відповідальних керівників. Тому вирішили , разом створити «FIND» - як, швидку та доступну платформа, для пошуку роботи в крутезних кав’яренях та наймі кваліфікованих бариста.
                        </div>
                    </div>
                </div>

                <div class="py-16 px-16 mb-16 rounded-[32px] bg-blue50">
                    <div class="flex items-center gap-8 max-w-[1488px] mx-auto">
                        <div class="max-w-[576px]">
                            <div class="mb-4 txt-h1">Вакансії для всіх!</div>
                            <div class="mb-[72px] txt-h4">Команда FIND знає як багато факторів впливає на вибір нового місця роботи, тому ми створили максимально якісний інструмент для створення вакансій, які допоможуть знайти працівника або нову роботу.</div>
                            <Link
                                :href="route('vacancies')"
                                class=" block text-center w-[424px] rounded-lg py-5 bg-gray0 text-gray90 txt-buttons"
                            >
                                Переглянути вакансії
                            </Link>
                        </div>
                        <div 
                            class="shrink-0 w-[880px] h-[495px] rounded-2xl image"
                            :style="{ backgroundImage: `url('/storage/static_images/home1.png')` }"
                        />
                    </div>
                </div>

                <div class="mb-16 py-16 px-16 rounded-[32px] bg-gray80">
                    <div class="flex items-center justify-between max-w-[1488px] mx-auto">
                        <div class="flex gap-8 mr-8">
                            <div
                                class="shrink-0 w-[272px] h-[590px] rounded-3xl image"
                                :style="{ backgroundImage: `url('/storage/static_images/home2.png')` }"
                            />
                            <div
                                class="shrink-0 w-[272px] h-[590px] rounded-3xl image"
                                :style="{ backgroundImage: `url('/storage/static_images/home3.png')` }"
                            />
                        </div>
                        <div class="max-w-[728px]">
                            <div class="mb-4 txt-h1">Шукай і в телефоні теж!</div>
                            <div class="mb-[72px] text-gray30 txt-h4">Команда FIND розуміє що потреба шукати роботу або працівників, може виникнути в будь який момент, тому ви можете використовувати наш сервіс, як з компютерів так і з телефонів.</div>
                            <Link
                                :href="start"
                                class="block text-center w-[424px] rounded-lg py-5 bg-blue50 txt-buttons"
                            >
                                Почати пошук
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="py-16 px-16 rounded-[32px] bg-blue50">
                    <div class="flex items-center gap-8 max-w-[1488px] mx-auto">
                        <div>
                            <div class="mb-4 txt-h1">Рейтинг та відгук!</div>
                            <div class="mb-[72px] txt-h4">Відгуки грають не маленьке значення під час будь-якого вибору, тому ми додали можливість залишати відгуки як на кав’ярня, так і на бариста.</div>
                            <Link
                                :href="start"
                                class="block text-center w-[424px] rounded-lg py-5 bg-gray0 text-gray90 txt-buttons"
                            >
                                Почати пошук
                            </Link>
                        </div>
                        <div 
                            class="relative shrink-0 w-[880px] h-[495px] rounded-2xl image"
                            :style="{ backgroundImage: `url('/storage/static_images/home4.png')` }"
                        >
                            <div
                                class="absolute right-[24px] top-[55px] w-[272px] h-[504px] rounded-2xl image"
                                :style="{ backgroundImage: `url('/storage/static_images/home5.png')` }"
                            />
                        </div>
                    </div>
                </div>
            </template>

            <template #mobile>
                <div class="w-fit mb-4 px-3 py-2 bg-blue50 rounded txt-body">Кав’ярні обирають FIND</div>
                <div class="mb-2 txt-h2">FIND - шукай роботу, якісно, швидко та зручно</div>
                <div class="mb-10 text-gray30 txt-h5">Місце, для пошуку роботи та кандидатів в сфері загального харчування</div>
                <Link
                    :href="start"
                    class="block mb-4 text-center rounded-lg py-3 bg-blue50 txt-buttons"
                >
                    Почати пошук!
                </Link>
                <div
                    @click="scrollToDetails(450)"
                    class="block mb-14 text-center border-solid border border-gray40 rounded-lg py-3 txt-buttons"
                >
                    Дізнатися більше
                </div>

                <div id="details-mob" class="mb-8 px-4 py-6 rounded-lg bg-gray80 scroll-mt-4">
                    <div class="flex items-center gap-2 w-fit mb-4 px-4 py-2 rounded-lg bg-blue50">
                        <div class="icon-idea" />
                        <div class="txt-h3">Ідея</div>
                    </div>
                    <div class="txt-body">Працюючи в цій сфері, ми постійно стикались із задачею пошуку кваліфікованих бариста. І коли, знаходили - то, дізнавались, що вони також шукають відповідальних керівників. Тому вирішили , разом створити «FIND» - як, швидку та доступну платформа, для пошуку роботи в крутезних кав’яренях та наймі кваліфікованих бариста.</div>
                </div>

                <div class="mb-8 p-4 rounded-lg bg-blue50">
                    <img src="/storage/static_images/home1.png" alt="" class="mb-4">
                    <div class="mb-2 txt-h1">Вакансії для всіх!</div>
                    <div class="mb-6 text-gray20 txt-h5">Команда FIND знає як багато факторів впливає на вибір нового місця роботи, тому ми створили максимально якісний інструмент для створення вакансій, які допоможуть знайти працівника або нову роботу.</div>
                    <Link 
                        :href="route('vacancies')"
                        class="block w-full py-3 rounded-lg bg-gray0 text-center text-gray90 txt-buttons"
                    >
                        Переглянути вакансії
                    </Link>
                </div>

                <div class="mb-8 p-4 rounded-lg bg-gray80">
                    <div class="flex justify-center flex-wrap gap-x-5 mb-4">
                        <img src="/storage/static_images/home2.png" alt="" class="max-h-[335px] mb-4">
                        <img src="/storage/static_images/home3.png" alt="" class="max-h-[335px] mb-4">
                    </div>
                    <div class="mb-2 txt-h1">Шукай в телефоні також!</div>
                    <div class="mb-6 text-gray30 txt-h5">Команда FIND розуміє що потреба шукати роботу або працівників, може виникнути в будь який момент, тому ви можете використовувати наш сервіс, як з компютерів так і з телефонів.</div>
                    <Link 
                        :href="start"
                        class="block w-full py-3 rounded-lg bg-gray0 text-center text-gray90 txt-buttons"
                    >
                        Почати пошук!
                    </Link>
                </div>

                <div class="p-4 rounded-lg bg-blue50">
                    <div class="relative">
                        <img src="/storage/static_images/home4.png" alt="" class="mb-4">
                        <img src="/storage/static_images/home5.png" alt="" class="absolute right-[13px] max-h-[175px] bottom-0">
                    </div>
                    <div class="mb-2 txt-h1">Рейтинг та відгук!</div>
                    <div class="mb-6 text-gray20 txt-h5">Відгуки грають не маленьке значення під час будь-якого вибору, тому ми додали можливість залишати відгуки як на кав’ярня, так і на бариста.</div>
                    <Link 
                        :href="start"
                        class="block w-full py-3 rounded-lg bg-gray0 text-center text-gray90 txt-buttons"
                    >
                        Почати пошук!
                    </Link>
                </div>
            </template>
        </MqResponsive>
    </MainLayout>
</template>
