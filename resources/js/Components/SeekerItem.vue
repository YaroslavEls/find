<script setup>
import { MqResponsive } from "vue3-mq";
import OptionsMenu from '@/Components/OptionsMenu.vue';
import Tags from '@/Components/Tags.vue';
import { Link, usePage } from '@inertiajs/vue3';

const props = defineProps({
    seeker: { 
        type: Object,
        required: true 
    }
});

const model = defineModel({ 
    type: [Number, String, null],
    required: true 
});

const options = (x) => {
    if (model.value == x) {
        model.value = null;
        return;
    }
    model.value = x;
};

const menuItems = () => {
    if (usePage().props.auth.user.saves.includes(props.seeker.id)) {
        return { unsave: route('unsave.seeker', { seeker: props.seeker }) }
    }

    return { save: route('save.seeker', { seeker: props.seeker }) };
};

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="relative flex mb-12">
                <Link :href="route('seekers.show', { seeker: seeker.id })" class="mr-8">
                    <div
                        class="min-w-[272px] w-[272px] h-[272px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                    />
                </Link>

                <div class="max-w-[880px] w-full mr-8">
                    <Tags
                        :tags="{ date: seeker.updated_at, exp: seeker.experience, empl: seeker.employment }"
                        class="mb-4"
                    />
                    <div class="mb-4 txt-h3">
                        {{ seeker.job }} - 
                        <span class="text-systemgreen">{{ (+seeker.salary).toLocaleString('de-DE') }}₴</span>
                    </div>
                    <div class="flex gap-2 mb-4 items-center text-gray20 txt-h5">
                        <div class="icon-location" />
                        <div>{{ seeker.city }}</div>
                    </div>
                    <Link
                        :href="route('seekers.show', { seeker: seeker.id })"
                        class="flex gap-2 mb-4 items-center w-fit text-blue30 txt-h5"
                    >
                        <div class="icon-person" />
                        <div>{{ seeker.name }}</div>
                    </Link>
                    <div class="mb-2 text-gray40 txt-body crop crop-2">
                        {{ seeker.info }}
                    </div>
                    <Link
                        :href="route('seekers.show', { seeker: seeker.id })"
                        class="block w-fit my-0 mr-0 ml-auto text-right text-blue40 txt-text-buttons"
                    >
                        Більше
                    </Link>
                </div>

                <div
                    @click="options(seeker.id)"
                    class="max-w-14 w-full h-10 my-0 mr-0 ml-auto rounded-lg icon-options bg-center bg-no-repeat bg-gray60 cursor-pointer hover:bg-gray70 duration-300"
                    :class="model == seeker.id ? 'close' : ''"
                />

                <OptionsMenu
                    v-show="model == seeker.id" 
                    :items="menuItems()"
                />
            </div>
        </template>

        <template #mobile>
            <div class="relative mb-8">
                <div
                    @click="options(seeker.id)"
                    class="absolute top-2 right-2 w-[29px] h-5 rounded icon-options bg-center bg-no-repeat bg-gray60"
                    :class="model == seeker.id ? 'close' : ''"
                />

                <OptionsMenu
                    v-show="model == seeker.id" 
                    :items="menuItems()"
                />

                <Link :href="route('seekers.show', { seeker: seeker.id })" class="block mb-4">
                    <div
                        class="w-full h-[202px] border-solid border-2 border-gray50 rounded-lg image"
                        :style="{ backgroundImage: `url('/${seeker.photo}')` }"
                    />
                </Link>

                <Tags
                    :tags="{ date: seeker.updated_at, exp: seeker.experience, empl: seeker.employment }"
                    class="mb-4"
                />

                <div class="mb-4 txt-h3">
                    {{ seeker.job }} - 
                    <span class="text-systemgreen">{{ (+seeker.salary).toLocaleString('de-DE') }}₴</span>
                </div>

                <div class="flex gap-2 mb-2 items-center txt-h5">
                    <div class="icon-location" />
                    <div>{{ seeker.city }}</div>
                </div>

                <Link
                    :href="route('seekers.show', { seeker: seeker.id })"
                    class="flex gap-2 mb-2 items-center text-blue30 txt-h5"
                >
                    <div class="icon-person" />
                    <div>{{ seeker.name }}</div>
                </Link>

                <div class="text-gray40 txt-body crop crop-2">
                    {{ seeker.info }}
                </div>
            </div>
        </template>
    </MqResponsive>
</template>
