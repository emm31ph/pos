import axios from 'axios'
import * as types from './mutation-types'


// state
export const state = {
    data: null,
}

// getters
export const getters = {
    data: state => state.data,
}

// mutations
export const mutations = {
    [types.FETCH_SERIAL_SUCCESS](state, { data }) {
        state.data = data
    },
    [types.FETCH_SERIAL_FAILURE](state) {
        state.data = null
    },
    [types.UPDATE_SERIAL](state, { data }) {
        state.data = data
    },
    [types.LOGOUT](state) {
        state.data = null
    },
}


// actions
export const actions = {

    async fetchSerial({ commit }, payload) {
        try {
            const { data } = await axios.get('/api/serial', {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                    branch: payload.branch,
                    key: payload.key,
                }
            })
            commit(types.FETCH_SERIAL_SUCCESS, { data: data })
        } catch (e) {
            commit(types.FETCH_SERIAL_FAILURE)
        }
    },

    async logout({ commit }) {
        commit(types.LOGOUT)
    },
}



export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations
}