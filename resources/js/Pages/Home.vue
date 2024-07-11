<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Carousel, Navigation, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

const reviews = [
    {
        photo: '/',
        name: 'Пустовіт Іван 1',
        job: 'Власник мережі кавярень ',
        saloon: 'Perezaryadka COFFEE',
        text: 'Працюючи в цій сфері, ми постійно стикались із задачею пошуку кваліфікованих бариста. І коли , знаходили - то, дізнавались , що вони також шукають відповідальних керівників. Тому вирішили , разом створити «FIND» - як, швидку та доступну платформа, для закриття кризових процесів, у пошуку роботи в крутезних кав’яренях та наймі кваліфікованих бариста.'
    },
    {
        photo: '/',
        name: 'Пустовіт Іван 2',
        job: 'Власник мережі кавярень ',
        saloon: 'Perezaryadka COFFEE',
        text: 'Працюючи в цій сфері, ми постійно стикались із задачею пошуку кваліфікованих бариста. І коли , знаходили - то, дізнавались , що вони також шукають відповідальних керівників. Тому вирішили , разом створити «FIND» - як, швидку та доступну платформа, для закриття кризових процесів, у пошуку роботи в крутезних кав’яренях та наймі кваліфікованих бариста.'
    }
];

</script>

<template>
    <Head title="Home" />
    
    <MainLayout>
        <!-- <Link :href="route('logout')" method="post" as="button" class="font-semibold text-[20px]">
            Log out
        </Link> -->

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
            <div class="flex justify-between gap-y-8 flex-wrap">
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

            <Carousel :wrap-around="true">
                <Slide v-for="review in reviews" :key="review">
                    <div class="max-w-[880px] w-full mx-auto my-0">
                        <div class="flex items-end gap-8 mb-4">
                            <img :src="review.photo" class="w-[86px] h-[86px] rounded-full bg-gray0">
                            <div>
                                <div class="mb-2 txt-h3">{{ review.name }}</div>
                                <div class="text-gray40 txt-h4">
                                    {{ review.job }}
                                    <span class="text-blue30">{{ review.saloon }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="txt-h5">{{ review.text }}</div>
                    </div>
                </Slide>

                <template #addons>
                    <Navigation />
                </template>
            </Carousel>
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

<style>
section.carousel {
    text-align: unset;
    padding: 0;
}

.carousel__prev {
    width: 92px;
    height: 96px;
    background-image: url("data:image/svg+xml,%3Csvg width='92' height='96' viewBox='0 0 92 96' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M46.0569 42.393C42.9327 45.5172 42.9327 50.5826 46.0569 53.7068L58.1 65.7499C58.7 66.3499 58.9833 67.0499 58.95 67.8499C58.9167 68.6499 58.6 69.3499 58 69.9499C57.4 70.5499 56.6833 70.8499 55.85 70.8499C55.0167 70.8499 54.3 70.5499 53.7 69.9499L33.9 50.1499C33.5667 49.8166 33.3333 49.4832 33.2 49.1499C33.0667 48.8166 33 48.4499 33 48.0499C33 47.6499 33.0667 47.2832 33.2 46.9499C33.3333 46.6166 33.5667 46.2832 33.9 45.9499L53.8 26.0499C54.4 25.4499 55.1167 25.1499 55.95 25.1499C56.7833 25.1499 57.5 25.4499 58.1 26.0499C58.7 26.6499 59 27.3666 59 28.1999C59 29.0332 58.7 29.7499 58.1 30.3499L46.0569 42.393Z' fill='white'/%3E%3C/svg%3E");
}

.carousel__next {
    width: 94px;
    height: 96px;
    background-image: url("data:image/svg+xml,%3Csvg width='94' height='96' viewBox='0 0 94 96' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M46.9431 53.6307C50.0673 50.5065 50.0673 45.4412 46.9431 42.317L34.9 30.2738C34.3 29.6738 34.0167 28.9738 34.05 28.1738C34.0833 27.3738 34.4 26.6738 35 26.0738C35.6 25.4738 36.3167 25.1738 37.15 25.1738C37.9833 25.1738 38.7 25.4738 39.3 26.0738L59.1 45.8738C59.4333 46.2072 59.6667 46.5405 59.8 46.8738C59.9333 47.2072 60 47.5738 60 47.9738C60 48.3738 59.9333 48.7405 59.8 49.0738C59.6667 49.4072 59.4333 49.7405 59.1 50.0738L39.2 69.9738C38.6 70.5738 37.9 70.8572 37.1 70.8238C36.3 70.7905 35.6 70.4738 35 69.8738C34.4 69.2738 34.1 68.5572 34.1 67.7238C34.1 66.8905 34.4 66.1738 35 65.5738L46.9431 53.6307Z' fill='white'/%3E%3C/svg%3E");
}

.carousel__prev .carousel__icon,
.carousel__next .carousel__icon {
    display: none;
}
</style>