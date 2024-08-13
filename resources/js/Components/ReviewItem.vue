<script setup>
import { MqResponsive } from "vue3-mq";
import OptionsMenu from '@/Components/OptionsMenu.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    review: {
        type: Object,
        required: true
    }
});

const selected = defineModel('selected', {
    type: [Number, null],
    required: true
});
const modal = defineModel('modal', {
    type: [String, null],
    required: false
});

const formatter = new Intl.DateTimeFormat('uk-UA', { day: 'numeric', month: 'long', year: 'numeric' });
const date = new Date(props.review.created_at);
const formattedDate = formatter.format(date);

const author = props.review.author.userable_type === 'App\\Models\\Saloon'
    ? { name: props.review.author.userable.name,
        photo: props.review.author.userable.logo,
        route: route('vacancies', { saloon: props.review.author.userable_id }) }
    : { name: props.review.author.userable.name,
        photo: props.review.author.userable.photo,
        route: route('seekers.show', { seeker: props.review.author.userable_id }) };

const options = (x) => {
    if (selected.value == x) {
        selected.value = null;
        return;
    }
    selected.value = x;
};

const menuItems = {
    delete: route('review.delete', { review: props.review.id })
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="relative flex justify-between">
                <div class="flex gap-4 w-[69%] mb-8 p-4 bg-gray70 rounded-xl">
                    <Link :href="author.route">
                        <div
                            class="w-14 h-14 border-solid border-1 border-gray50 rounded-full image"
                            :style="{ backgroundImage: `url('/${author.photo}')` }"
                        />
                    </Link>
                    
                    <div class="grow">
                        <div class="flex justify-between items-center">
                            <Link :href="author.route">
                                <div class="txt-h4">{{ author.name }}</div>
                            </Link>
                            <div class="text-gray30 txt-secondary">{{ formattedDate }}</div>
                        </div>

                        <div class="flex gap-1 mb-4">
                            <div
                                v-for="x in 5"
                                :key="x"
                                class="icon-star-small"
                                :class="review.score < x ? 'gray' : ''"
                            />
                        </div>
                        
                        <div class="whitespace-pre-wrap txt-body">{{ review.text }}</div>
                    </div>
                </div>

                <div
                    v-if="review.author_id == $page.props.auth.user.user_id"
                    @click="options(review.id)"
                    class="w-14 h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat cursor-pointer hover:bg-blue40 duration-300"
                    :class="selected == review.id ? 'bg-gray70' : 'bg-gray50'"
                />

                <OptionsMenu
                    v-show="selected == review.id" 
                    :items="menuItems"
                    v-model="modal"
                />
            </div>
        </template>

        <template #mobile>
            <div class="mb-2 p-4 bg-gray70 rounded-xl">
                <div
                    v-if="review.author_id == $page.props.auth.user.user_id"
                    class="relative flex justify-between items-center mb-4"
                >
                    <div class="text-blue40 txt-secondary">Ваш відгук</div>
                    <div
                        @click="options(review.id)"
                        class="w-[29px] h-5 rounded icon-options bg-center bg-no-repeat bg-gray50"
                    />
                    <div class="absolute top-[-4px] right-[-8px]">
                        <OptionsMenu
                            v-show="selected == review.id" 
                            :items="menuItems"
                            v-model="modal"
                            bg
                        />
                    </div>
                </div>

                <Link :href="author.route" class="flex gap-2 items-center mb-4 w-fit">
                    <div
                        class="w-12 h-12 border-solid border-1 border-gray50 rounded-full image"
                        :style="{ backgroundImage: `url('/${author.photo}')` }"
                    />
                    <div>
                        <div class="mb-1 txt-h4">{{ author.name }}</div>
                        <div class="flex gap-1">
                            <div
                                v-for="x in 5"
                                :key="x"
                                class="icon-star-xs"
                                :class="review.score < x ? 'gray' : ''"
                            />
                        </div>
                    </div>
                </Link>

                <div class="mb-4 whitespace-pre-wrap txt-body">{{ review.text }}</div>
                <div class="text-right text-gray30 txt-secondary">{{ formattedDate }}</div>
            </div>
        </template>
    </MqResponsive>
</template>
