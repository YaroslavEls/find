<script setup>
import { MqResponsive } from "vue3-mq";

defineProps({
    saloon: {
        type: Object,
        required: true
    }
});

</script>

<template>
    <MqResponsive group>
        <template #desktop>
            <div class="flex items-center gap-6">
                <div
                    class="w-16 h-16 border-solid border-2 border-gray50 rounded-full image"
                    :style="{ backgroundImage: `url('/${saloon.logo}')` }"
                />
                <div>
                    <div class="txt-h1">{{ saloon.name }}</div>
                    <div class="flex gap-1 mt-2">
                        <div
                            v-for="x in 5"
                            :key="x"
                            class="icon-star-small"
                            :class="saloon.score < x ? 'gray' : ''"
                        />
                    </div>
                </div>
            </div>
        </template>

        <template #mobile>
            <div class="flex items-center gap-2">
                <div
                    class="w-14 h-14 border-solid border-2 border-gray50 rounded-full image"
                    :style="{ backgroundImage: `url('/${saloon.logo}')` }"
                />
                <div>
                    <div class="mb-2 txt-h2">{{ saloon.name }}</div>
                    <div class="flex gap-1">
                        <div
                            v-for="x in 5"
                            :key="x"
                            class="icon-star-small"
                            :class="saloon.score < x ? 'gray' : ''"
                        />
                    </div>
                </div>
            </div>
        </template>
    </MqResponsive>
</template>
