<script>
const PositiveIntegerValidator = (value) => {
    return parseInt(value) >= 0;
};

import PawPrint from "./PawPrint.vue";

export default {
    components: {
        PawPrint,
    },
    props: {
        currentStep: {
            type: Number,
            required: true,
            validator: PositiveIntegerValidator,
        },
        totalSteps: {
            type: Number,
            required: true,
            validator: PositiveIntegerValidator,
        },
    },
    data() {
        return {
            //
        };
    },
    methods: {
        //
    },
    mounted() {
        //
    },
};
</script>

<template>
    <ul class="flex items-center justify-between space-x-6">
        <li
            class="grid grid-cols-2 items-center gap-x-6"
            v-for="i in totalSteps"
            :key="`step-${i}`"
        >
            <paw-print
                class="rotate-90 col-span-1 w-8 transition-colors duration-300"
                :class="{
                    'text-gray-200': currentStep < i,
                    'text-green-400': currentStep >= i,
                }"
            />
            <paw-print
                class="rotate-90 mt-8 col-span-1 w-8 transition-colors duration-300"
                :class="{
                    'text-gray-200': currentStep < i,
                    'text-green-400': currentStep >= i,
                }"
            />
        </li>
    </ul>
</template>
