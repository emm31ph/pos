import Vue from "vue";
require("./bootstrap");
window.Vue = require("vue");
import store from "~/store";
import router from "~/router";

import App from "~/components/App";
import "~/components";
import "~/extra";
import "~/modal";
import "~/mixins";
import "~/plugins";

import AOS from "aos";
import "aos/dist/aos.css";
AOS.init();

import swiper from "swiper";
import "swiper/css";

window.Swal = require("sweetalert2");

import JsonExcel from "vue-json-excel";
Vue.component("downloadExcel", JsonExcel);

const app = new Vue({
    store,
    router,
    ...App,
});
