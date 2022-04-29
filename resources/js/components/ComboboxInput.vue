<template>
    <Combobox v-model="selected" nullable>
        <div class="relative mt-1">
            <div
                class="focus:outline-none relative w-full cursor-default overflow-hidden rounded-lg bg-white text-left shadow focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-teal-300 sm:text-sm"
            >
                <ComboboxInput
                    class="w-full border-none py-2 pl-3 pr-10 text-sm leading-5 text-gray-900 focus:ring-0"
                    :displayValue="(option) => option?.label"
                    @change="query = $event.target.value"
                />
                <ComboboxButton
                    class="absolute inset-y-0 right-0 flex items-center pr-2"
                >
                    <SelectorIcon
                        class="h-5 w-5 text-gray-400"
                        aria-hidden="true"
                    />
                </ComboboxButton>
            </div>
            <TransitionRoot
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
                @after-leave="query = ''"
            >
                <ComboboxOptions
                    class="focus:outline-none absolute mt-1 max-h-60 w-full overflow-auto rounded-md bg-white py-1 text-base shadow ring-1 ring-black ring-opacity-5 sm:text-sm"
                >
                    <div
                        v-if="filteredOption.length === 0 && query !== ''"
                        class="relative cursor-default select-none py-2 px-4 text-gray-700"
                    >
                        Nothing found.
                    </div>

                    <ComboboxOption
                        v-for="option in filteredOption"
                        as="template"
                        :key="option?.key"
                        :value="option"
                        v-slot="{ selected, active }"
                    >
                        <li
                            class="relative cursor-default select-none py-2 pl-10 pr-4"
                            :class="{
                                'bg-teal-600 text-white': active,
                                'text-gray-900': !active,
                            }"
                        >
                            <span
                                class="block truncate"
                                :class="{
                                    'font-medium': selected,
                                    'font-normal': !selected,
                                }"
                            >
                                {{ option.label }}
                            </span>
                            <span
                                v-if="selected"
                                class="absolute inset-y-0 left-0 flex items-center pl-3"
                                :class="{
                                    'text-white': active,
                                    'text-teal-600': !active,
                                }"
                            >
                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                            </span>
                        </li>
                    </ComboboxOption>
                </ComboboxOptions>
            </TransitionRoot>
        </div>
    </Combobox>
</template>

<script>
import {
    Combobox,
    ComboboxInput,
    ComboboxButton,
    ComboboxOptions,
    ComboboxOption,
    TransitionRoot,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";

export default {
    components: {
        Combobox,
        ComboboxInput,
        ComboboxButton,
        ComboboxOptions,
        ComboboxOption,
        TransitionRoot,
        CheckIcon,
        SelectorIcon,
    },
    props: {
        options: {
            type: Array,
            default: [],
        },
        value: {},
    },
    computed: {
        filteredOption() {
            return this.query === ""
                ? this.options
                : this.options.filter((option) =>
                      option.label
                          .toLowerCase()
                          .replace(/\s+/g, "")
                          .includes(
                              this.query.toLowerCase().replace(/\s+/g, "")
                          )
                  );
        },
    },
    watch: {
        selected(newValue) {
            //
        },
        value() {},
    },
    data() {
        return {
            selected: null,
            query: "",
        };
    },
};
</script>
