<script>
import PetFormStepper from "./PetFormStepper.vue";
import ComboboxInput from "./ComboboxInput.vue";
import Axios from "axios";

export default {
    props: {
        speciesOptions: {
            type: Array,
            default: [],
        },
    },
    components: {
        PetFormStepper,
        ComboboxInput,
    },
    watch: {
        "form.pet_species_id": {
            handler(value, oldValue) {
                if (value && value != oldValue)
                    this.fetchPetBreedBySpeciesId(value);
            },
        },
        selected_pet_species: {
            handler(value) {
                this.form.pet_species_id = value?.key;
                this.selected_pet_breed = null;
            },
        },
        selected_pet_breed: {
            handler(value) {
                this.form.pet_breed_id = value?.key;
            },
        },
    },
    data() {
        return {
            form: {
                name: null,
                pet_species_id: null,
                pet_breed_id: null,
                breed: null,
                gender: null,
            },
            selected_pet_species: null,
            selected_pet_breed: null,
            breedOptions: [],
            busy: false,
            successful: false,
            errors: {},
            breed_meta: null,
        };
    },
    methods: {
        resetForm() {
            this.form.name = "";
            this.form.pet_species_id = null;
            this.form.pet_breed_id = null;
            this.form.gender = null;
            this.selected_pet_species = null;
            this.selected_pet_breed = null;
        },
        fetchPetBreedBySpeciesId(speciesId) {
            if (!speciesId) return;

            this.busy = true;

            Axios.get(`/api/breed/?filter[pet_species_id]=${speciesId}`)
                .then((response) => {
                    this.breedOptions = response.data;
                })
                .catch((error) => {})
                .finally(() => {
                    this.busy = false;
                });
        },
        submit() {
            this.busy = true;

            Axios.post("/api/pet", this.form)
                .then((response) => {
                    this.errors = this.successful = true;
                    this.resetForm();
                })
                .catch((e) => {
                    this.successful = false;
                    if (e.response?.data) this.errors = e.response.data.errors;
                })
                .finally(() => {
                    this.busy = false;
                });
        },
    },
    computed: {
        currentStep() {
            let value = 0;

            if (this.form.name?.length ?? 0 > 0) value++;

            if (this.form.pet_species_id) value++;

            if (this.form.pet_breed_id || this.form.pet_breed) value++;

            if (this.form.gender) value++;

            return value;
        },
        speciesOptionsKeyValue() {
            return this.speciesOptions.map((species) => {
                return { key: species.id, label: species.name };
            });
        },
        breedOptionsKeyValue() {
            return this.breedOptions.map((breed) => {
                return { key: breed.id, label: breed.name };
            });
        },
    },
    mounted() {
        //
    },
};
</script>

<template>
    <form
        @submit.prevent="submit"
        autocomplete="off"
        role="form"
        class="bg-white rounded-md shadow border-gray-200 px-8 py-4 w-full max-w-lg mx-auto my-8 flex flex-col space-y-4"
    >
        <pet-form-stepper
            :totalSteps="4"
            :currentStep="currentStep"
        ></pet-form-stepper>

        <h3 class="text-sky-800 font-semibold text-xl">
            Tell us about your dog
        </h3>

        <label for="name">What is your dog's name?</label>
        <input
            type="text"
            v-model="form.name"
            name="name"
            class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            required
        />

        <div>
            <label for="pet_breed_id">What species are they?</label>
            <combobox-input
                v-model="selected_pet_species"
                :options="speciesOptionsKeyValue"
            ></combobox-input>
        </div>

        <div>
            <label for="pet_breed_id">What breed are they?</label>
            <combobox-input
                v-model="selected_pet_breed"
                :options="breedOptionsKeyValue"
                :disabled="!form.pet_species_id"
            ></combobox-input>
        </div>

        <div class="px-4" v-if="form.pet_species_id && !form.pet_breed_id">
            <label for="breed_meta" class="block w-full">Choose One</label>
            <label class="block w-full"
                ><input
                    type="radio"
                    name="breed_meta"
                    v-model="breed_meta"
                    value="unknown"
                />
                I don't know</label
            >
            <label class="block w-full"
                ><input
                    type="radio"
                    name="breed_meta"
                    v-model="breed_meta"
                    value="mixed"
                />
                It's a mix</label
            >
            <input
                v-if="breed_meta == 'mixed'"
                type="text"
                name="pet_breed"
                v-model="form.pet_breed"
                placeholder="What breeds are they mixed with?"
                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
            />
        </div>

        <label for="gender">What gender are they?</label>
        <label
            ><input
                type="radio"
                name="gender"
                value="male"
                v-model="form.gender"
            />
            Male</label
        >
        <label
            ><input
                type="radio"
                name="gender"
                value="female"
                v-model="form.gender"
            />
            Female</label
        >

        <div class="flex justify-center">
            <button
                class="rounded bg-sky-800 text-white px-12 py-2 flex space-x-2"
                :class="{ 'bg-sky-100 text-gray-500': busy }"
            >
                Save
                <span v-show="busy" class="spinne"
                    ><svg
                        class="w-6 h-6 animate-spin relative text-gray-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"
                        ></path></svg
                ></span>
            </button>
        </div>

        <p
            v-if="successful"
            class="bg-green-50 border-green-300 text-black rounded px-4 py-2"
        >
            Your pet has been successfully saved.
        </p>
        <ul
            v-if="errors && Object.keys(errors).length"
            class="bg-red-50 border-red-300 text-black rounded px-4 py-2"
        >
            <li v-for="(error, i) in errors" :key="`error-${i}`">
                {{ error[0] }}
            </li>
        </ul>
    </form>
</template>
