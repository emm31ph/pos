import Vue from 'vue'
import store from '~/store'
import axios from 'axios'
import { mapState } from "vuex";

Vue.mixin({
    computed: {

        ...mapState({ serial: (state) => state.Serial.data }),
    },
    methods: {
        MFetchSerial() {
            this.$store.dispatch("Serial/fetchSerial", {
                trnmode: "getItem",
                trnmode: "getItem",
                trnmode: "getItem",
                trnmode: "getItem",
            });
        }
    }
})