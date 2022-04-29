require("./bootstrap");

import { createApp } from "vue";
import PetForm from "./components/PetForm.vue";

const app = createApp({});

app.component("pet-form", PetForm).mount("#app");
