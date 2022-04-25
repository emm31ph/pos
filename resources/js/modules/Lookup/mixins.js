import Vue from 'vue'
import store from '~/store'
import axios from 'axios'
import { mapState } from "vuex";

Vue.mixin({
    computed: {
        ...mapState({ getLookup: (state) => state.Lookup.list }),
    },
    methods: {
        mFetchLookup(data) {

            if (data) {
                let val = this.getLookup;

                if (val) {
                    console.log(val.filter(function(el) {
                        console.log(el.code.lookup);

                        return el.code === data
                    }));

                    var val1 = val.filter((el) => el.code === data);

                    if (val1.length) {

                        return val1
                    }
                }
                return [];
            }
            return [];
        },

    }

})