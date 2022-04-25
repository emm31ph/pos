import Vue from 'vue'
import store from '~/store'
import axios from 'axios'

Vue.mixin({
    computed: {
        getBranch() {
            const data = store.getters['Branch/list']
            if (data) {
                return data
            }
            return false
        },
    },

    methods: {}


})