<script setup>
import { useMq } from "vue3-mq";

const mq = useMq();

</script>

<template>
    <div class="relative mb-8">
        <div v-if="$slots.heading" class="flex justify-between items-end mb-1">
            <div class="txt-h5" :class="$slots.error ? 'text-systemred' : ''">
                <slot name="heading" />
            </div>
            <div v-if="$slots.subheading" class="text-gray40 txt-secondary">
                <slot name="subheading" />
            </div>
        </div>
        
        <slot />

        <div v-if="$slots.note" class="mt-1 text-gray40 txt-secondary">
            <slot name="note" />
        </div>

        <div v-if="$slots.error" class="mt-1 text-systemred txt-secondary">
            <slot name="error" />
        </div>
    </div>
</template>
