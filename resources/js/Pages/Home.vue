<script setup>
import { MqResponsive } from "vue3-mq";
import MainLayout from '@/Layouts/MainLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Carousel, Navigation, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
import { ref } from 'vue';

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

const howto = [
    {
        heading: 'Як знайти роботу?',
        subheading: 'Я шукаю бариста!',
        1: {
            top: 'Зареєструйся та заповний свій профіль!',
            bottom: 'Для більш ефективного пошуку роботи, заповни всі можливі поля.'
        },
        2: {
            top: 'Відфільтруй вакансії, щоб підібрати для себе найкрутішу!',
            bottom: 'Читай відгуки та дивись рейтинг це дуже допоможе покращити наш ринок праці'
        },
        3: {
            top: 'Знайшовши для себе вакансію або кавярню напиши їм та домовся про зустріч!',
            bottom: 'Використовуй тільки наш чат! Для уникнення шахрайства.'
        },
        route: route('vacancies')
    },
    {
        heading: 'Як знайти Бариста?',
        subheading: 'Я шукаю роботу!',
        1: {
            top: 'Створи та заповни профіль закладу або мережі, додай наявні локації та графіки роботи.',
            bottom: null
        },
        2: {
            top: 'Створи вакансію для потрібної локації, та заповни всю потрібну інформацію!',
            bottom: null
        },
        3: {
            top: 'Тепер зачекай поки когось зацікавить ваша вакансія, або сам пошукай цікавих кандидатів та зв’яжися з ними)',
            bottom: null
        },
        route: route('seekers')
    },
];

const currentHowTo = ref(0);

</script>

<template>
    <Head title="Home" />
    
    <MainLayout>
        <MqResponsive group>
            <template #desktop>
                <div class="pb-16">
                    <div class="w-fit px-6 py-3 mb-4 bg-blue50 rounded-lg txt-h5">Платформа для пошуку роботи</div>
                    <div class="max-w-[1032px] font-semibold text-[80px] leading-[110%] mb-4">FIND - шукай роботу, якісно, швидко та зручно</div>
                    <div class="max-w-[728px] mb-16 text-gray30 txt-h3">Місце, для пошуку роботи та кандидатів в сфері загального харчування</div>
                    <div class="flex gap-8 justify-end">
                        <Link
                            :href="route('seekers')"
                            class="text-center w-[424px] rounded-lg py-[18px] border-solid border-2 border-gray40 txt-buttons"
                        >
                            Переглянути кандидатів
                        </Link>
                        <Link
                            :href="route('vacancies')"
                            class="text-center w-[424px] rounded-lg py-5 bg-blue50 txt-buttons"
                        >
                        Переглянути вакансії
                        </Link>
                    </div>
                </div>

                <div class="py-16">
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
                </div>
                
                <div class="py-16">
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
                </div>

                <div class="pt-16">
                    <div class="flex justify-between items-center">
                        <div class="mb-6 txt-h1">{{ howto[currentHowTo].heading }}</div>
                        <div
                            @click="currentHowTo = currentHowTo === 0 ? 1 : 0"
                            class="text-blue40 txt-buttons cursor-pointer"
                        >
                            {{ howto[currentHowTo].subheading }}
                        </div>
                    </div>
                    
                    <div>
                        <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                            <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">1</div>
                            <div class="max-w-[835px]">
                                <div class="mb-2 txt-h3">{{ howto[currentHowTo][1].top }}</div>
                                <div class="text-blue30 txt-body">{{ howto[currentHowTo][1].bottom }}</div>
                            </div>
                        </div>
                        <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                            <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">2</div>
                            <div class="max-w-[835px]">
                                <div class="mb-2 txt-h3">{{ howto[currentHowTo][2].top }}</div>
                                <div class="text-blue30 txt-body">{{ howto[currentHowTo][2].bottom }}</div>
                            </div>
                        </div>
                        <div class="border-solid border-2 border-gray40 rounded-2xl px-20 flex h-[152px] items-center mb-6">
                            <div class="font-semibold text-[64px] leading-[110%] w-10 text-center mr-[206px]">3</div>
                            <div class="max-w-[835px]">
                                <div class="mb-2 txt-h3">{{ howto[currentHowTo][3].top }}</div>
                                <div class="text-blue30 txt-body">{{ howto[currentHowTo][3].bottom }}</div>
                            </div>
                        </div>
                    </div>
                    <Link
                        :href="howto[currentHowTo].route" 
                        class="block w-[576px] bg-blue50 mt-16 mx-auto p-5 text-center rounded-xl txt-buttons"
                    >
                        Почати пошук!
                    </Link>
                </div>
            </template>

            <template #mobile>
                <div class="w-fit mb-4 px-3 py-2 bg-blue50 rounded txt-body">Платформа для пошуку роботи</div>
                <div class="mb-2 txt-h2">FIND - шукай роботу, якісно, швидко та зручно</div>
                <div class="mb-10 text-gray30 txt-h5">Місце, для пошуку роботи та кандидатів в сфері загального харчування</div>
                <Link
                    :href="route('vacancies')"
                    class="block mb-4 text-center rounded-lg py-3 bg-blue50 txt-buttons"
                >
                    Переглянути вакансії
                </Link>
                <Link
                    :href="route('seekers')"
                    class="block mb-16 text-center rounded-lg py-3 border-solid border border-gray40 txt-buttons"
                >
                    Переглянути кандидатів
                </Link>

                <div class="mb-2 txt-h2">Наші переваги!</div>
                <div class="mb-4 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="w-fit mb-2 px-3 py-[6px] bg-blue50 rounded txt-body">Швидко та просто</div>
                    <div class="txt-h5">Простий дизайн який допоможе легко та максимально ефективно знайти нову роботу або новго бариста.</div>
                </div>
                <div class="mb-4 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="w-fit mb-2 px-3 py-[6px] bg-blue50 rounded txt-body">Рейтинг</div>
                    <div class="txt-h5">Переглядай рейтинг та відгуки як про кавʼярні так і про кандидатів, залишай свої відгуки.</div>
                </div>
                <div class="mb-4 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="w-fit mb-2 px-3 py-[6px] bg-blue50 rounded txt-body">Варіанти</div>
                    <div class="txt-h5">FIND - має велику базу як кав’ярень так і барист по всій україні.</div>
                </div>
                <div class="mb-16 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="w-fit mb-2 px-3 py-[6px] bg-blue50 rounded txt-body">Чат</div>
                    <div class="txt-h5">FIND - має свій чат, для твоєї зручності, та спрощення процесу пошуку роботи.</div>
                </div>

                <div class="mb-2 txt-h2">Відгуки про FIND</div>
                <Carousel :wrap-around="true" class="mb-16">
                    <Slide v-for="review in reviews" :key="review">
                        <div class="max-w-[313px] w-full mx-auto my-0">
                            <div class="flex items-center gap-2 mb-2">
                                <img :src="review.photo" class="w-12 h-12 rounded-full bg-gray0">
                                <div>
                                    <div class="txt-h4">{{ review.name }}</div>
                                    <div class="text-gray40 txt-secondary">
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

                <div class="mb-2 txt-h2">{{ howto[currentHowTo].heading }}</div>
                <div class="flex mb-4">
                    <div
                        @click="currentHowTo = 0"
                        class="basis-1/2 py-3 rounded-l-lg text-center txt-text-buttons"
                        :class="currentHowTo === 0 ? 'bg-blue50' : 'bg-gray60'"
                    >
                        Я бариста
                    </div>
                    <div
                        @click="currentHowTo = 1"
                        class="basis-1/2 py-3 rounded-r-lg text-center txt-text-buttons"
                        :class="currentHowTo === 1 ? 'bg-blue50' : 'bg-gray60'"
                    >
                        Я роботодавець
                    </div>
                </div>
                <div class="mb-4 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="txt-h5">{{ howto[currentHowTo][1].top }}</div>
                    <div 
                        v-show="howto[currentHowTo][1].bottom" 
                        class="mt-2 text-blue30 txt-secondary"
                    >
                        {{ howto[currentHowTo][1].bottom }}
                    </div>
                </div>
                <div class="mb-4 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="txt-h5">{{ howto[currentHowTo][2].top }}</div>
                    <div
                        v-show="howto[currentHowTo][1].bottom"
                        class="mt-2 text-blue30 txt-secondary"
                    >
                        {{ howto[currentHowTo][2].bottom }}
                    </div>
                </div>
                <div class="mb-16 p-4 border-solid border border-gray40 rounded-lg">
                    <div class="txt-h5">{{ howto[currentHowTo][3].top }}</div>
                    <div
                        v-show="howto[currentHowTo][1].bottom"
                        class="mt-2 text-blue30 txt-secondary"
                    >
                        {{ howto[currentHowTo][3].bottom }}
                    </div>
                </div>

                <Link
                    :href="howto[currentHowTo].route" 
                    class="block text-center rounded-lg py-3 bg-blue50 txt-buttons"
                >
                    Почати пошук
                </Link>
            </template>
        </MqResponsive>
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

@media only screen and (max-width: 768px) {
    .carousel__prev {
        margin: 0;
        left: -15px;
        width: 40px;
        height: 40px;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cmask id='mask0_584_7519' style='mask-type:alpha' maskUnits='userSpaceOnUse' x='0' y='0' width='40' height='40'%3E%3Crect width='40' height='40' fill='%23D9D9D9'/%3E%3C/mask%3E%3Cg mask='url(%23mask0_584_7519)'%3E%3Cpath d='M17.2773 19.972L24.3607 27.0553C24.629 27.3239 24.7586 27.6481 24.7494 28.0278C24.7403 28.4073 24.6014 28.7313 24.3328 28.9999C24.0641 29.2685 23.7354 29.4028 23.3465 29.4028C22.9576 29.4028 22.629 29.2685 22.3607 28.9999L14.3048 20.9445C14.1568 20.7962 14.0526 20.6434 13.9923 20.4862C13.9323 20.3287 13.9023 20.1573 13.9023 19.972C13.9023 19.787 13.9323 19.6158 13.9923 19.4583C14.0526 19.3008 14.1568 19.148 14.3048 18.9999L22.3882 10.9166C22.6568 10.648 22.9855 10.5137 23.3744 10.5137C23.7633 10.5137 24.0921 10.648 24.3607 10.9166C24.629 11.1852 24.7632 11.5139 24.7632 11.9028C24.7632 12.2917 24.629 12.6203 24.3607 12.8887L17.2773 19.972Z' fill='%23A9B2C2'/%3E%3C/g%3E%3C/svg%3E");
    }

    .carousel__next {
        margin: 0;
        right: -15px;
        width: 40px;
        height: 40px;
        background-image: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cmask id='mask0_584_7513' style='mask-type:alpha' maskUnits='userSpaceOnUse' x='0' y='0' width='40' height='40'%3E%3Crect width='40' height='40' fill='%23D9D9D9'/%3E%3C/mask%3E%3Cg mask='url(%23mask0_584_7513)'%3E%3Cpath d='M21.7225 19.9719L14.6392 12.8886C14.3709 12.6203 14.2413 12.2962 14.2505 11.9165C14.2596 11.5368 14.3985 11.2128 14.6671 10.9444C14.9357 10.6758 15.2645 10.5415 15.6534 10.5415C16.0423 10.5415 16.3709 10.6758 16.6392 10.9444L24.695 18.9998C24.8431 19.1479 24.9473 19.3007 25.0075 19.4582C25.0675 19.6157 25.0975 19.7869 25.0975 19.9719C25.0975 20.1572 25.0675 20.3286 25.0075 20.4861C24.9473 20.6433 24.8431 20.7961 24.695 20.9444L16.6117 29.0278C16.3431 29.2961 16.0189 29.4257 15.6392 29.4165C15.2598 29.4073 14.9357 29.2684 14.6671 28.9998C14.3985 28.7312 14.2642 28.4025 14.2642 28.0136C14.2642 27.6247 14.3985 27.2961 14.6671 27.0278L21.7225 19.9719Z' fill='%23A9B2C2'/%3E%3C/g%3E%3C/svg%3E");
    }
}
</style>
