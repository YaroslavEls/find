<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Home" />

    <MainLayout>
        <Link :href="route('logout')" method="post" as="button" class="font-semibold text-[20px]">
            Log out
        </Link>
        {{ $page.props.auth.user }}
        <section>
            <div class="w-fit px-6 py-3 mb-4 bg-blue50 rounded-lg txt-h5">Платформа для пошуку роботи</div>
            <div class="max-w-[1032px] font-semibold text-[80px] leading-[110%] mb-4">FIND - шукай роботу, якісно, швидко та зручно</div>
            <div class="max-w-[728px] mb-16 text-gray30 txt-h3">Місце, для пошуку роботи та кандидатів в сфері загального харчування</div>
            <div class="flex gap-8 justify-end">
                <div class="text-center w-[424px] rounded-lg py-[18px] border-solid border-2 border-gray40 txt-buttons">Переглянути кандидатів</div>
                <div class="text-center w-[424px] rounded-lg py-5 bg-blue50 txt-buttons">Переглянути вакансії</div>
            </div>
        </section>

        <section>
            <div class="mb-6 txt-h1">Наші переваги!</div>
            <div class="flex justify-between gap-8 flex-wrap">
                <div class="border-solid border-2 border-gray40 rounded-2xl w-[48.9%] px-8 py-10">
                    <div class="w-fit px-6 py-3 rounded-xl bg-blue50 mb-4 txt-h4">Швидко та просто</div>
                    <div class="txt-h4">Простий дизайн який допоможе легко та максимально ефективно знайти нову роботу або новго бариста.</div>
                </div>
                <div class="border-solid border-2 border-gray40 rounded-2xl w-[48.9%] px-8 py-10">
                    <div class="w-fit px-6 py-3 rounded-xl bg-blue50 mb-4 txt-h4">Рейтинг</div>
                    <div class="txt-h4">Переглядай рейтинг та відгуки як про кавʼярні так і про кандидатів, залишай свої відгуки.</div>
                </div>
                <div class="border-solid border-2 border-gray40 rounded-2xl w-[48.9%] px-8 py-10">
                    <div class="w-fit px-6 py-3 rounded-xl bg-blue50 mb-4 txt-h4">Варіанти</div>
                    <div class="txt-h4">FIND - має велику базу як кав’ярень так і барист по всій україні.</div>
                </div>
                <div class="border-solid border-2 border-gray40 rounded-2xl w-[48.9%] px-8 py-10">
                    <div class="w-fit px-6 py-3 rounded-xl bg-blue50 mb-4 txt-h4">Чат</div>
                    <div class="txt-h4">FIND - має свій чат, для твоєї зручності, та спрощення процесу пошуку роботи.</div>
                </div>
            </div>
        </section>
        
        <section>
            <div class="mb-6 txt-h1">Відгуки про FIND</div>
            <div>
                <div class="max-w-[880px] w-full mx-auto my-0">
                    <div class="flex items-end gap-8 mb-4">
                        <div class="w-[86px] h-[86px] rounded-[40px] bg-gray0"></div>
                        <div>
                            <div class="mb-2 txt-h3">Пустовіт Іван</div>
                            <div class="text-gray40 txt-h4">
                                Власник мережі кавярень 
                                <span class="text-blue30">Perezaryadka COFFEE</span>
                            </div>
                        </div>
                    </div>
                    <div class="txt-h5">Працюючи в цій сфері, ми постійно стикались із задачею пошуку кваліфікованих бариста. І коли , знаходили - то, дізнавались , що вони також шукають відповідальних керівників. Тому вирішили , разом створити «FIND» - як, швидку та доступну платформа, для закриття кризових процесів, у пошуку роботи в крутезних кав’яренях та наймі кваліфікованих бариста.</div>
                </div>
            </div>
        </section>

        <section>
            <div class="mb-6 txt-h1">Як знайти роботу?</div>
            <div>
                <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                    <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">1</div>
                    <div class="max-w-[835px]">
                        <div class="mb-2 txt-h3">Зареєструйся та заповний свій профіль!</div>
                        <div class="text-blue30 txt-body">Для більш ефективного пошуку роботи, заповни всі можливі поля.</div>
                    </div>
                </div>
                <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                    <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">2</div>
                    <div class="max-w-[835px]">
                        <div class="mb-2 txt-h3">Відфільтруй вакансії, щоб підібрати для себе найкрутішу!</div>
                        <div class="text-blue30 txt-body">Читай відгуки та дивись рейтинг це дуже допоможе покращити наш ринок праці</div>
                    </div>
                </div>
                <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                    <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">3</div>
                    <div class="max-w-[835px]">
                        <div class="mb-2 txt-h3">Знайшовши для себе вакансію або кавярню напиши їм та домовся про зустріч!</div>
                        <div class="text-blue30 txt-body">Використовуй тільки наш чат! Для уникнення шахрайства.</div>
                    </div>
                </div>
            </div>
            <div class="w-[576px] bg-blue50 mt-16 mx-auto p-5 text-center rounded-xl txt-buttons">Почати пошук!</div>
        </section>

    </MainLayout>
</template>
