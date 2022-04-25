import axios from 'axios'
import * as types from './mutation-types'


// state
export const state = {
    list: null,
    userlist: null,
}

// getters
export const getters = {
    list: state => state.list,
    userlist: state => state.userlist,
}

// mutations
export const mutations = {
    [types.FETCH_LOOKUP_SUCCESS](state, { list }) {
        state.list = list
    },
    [types.FETCH_LOOKUP_FAILURE](state) {
        state.list = null
    },
    [types.UPDATE_LOOKUP](state, { list }) {
        state.list = list
    },
    [types.FETCH_LOOKUPUSER_SUCCESS](state, { userlist }) {
        state.userlist = userlist
    },
    [types.FETCH_LOOKUPUSER_FAILURE](state) {
        state.userlist = null
    },
    [types.UPDATE_LOOKUPUSER](state, { userlist }) {
        state.userlist = userlist
    },
    [types.LOGOUT](state) {
        state.list = null
        state.userlist = null

    },

}


// actions
export const actions = {

    async fetchLookup({ commit }, payload) {
        try {
            const { data } = await axios.get('/api/lookup', {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                }
            })
            commit(types.FETCH_LOOKUP_SUCCESS, { list: data })
        } catch (e) {
            commit(types.FETCH_LOOKUP_FAILURE)
        }
    },

    async fetchUserLookup({ commit }, payload) {
        try {
            const { data } = await axios.get('/api/lookup', {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                }
            })
            commit(types.FETCH_LOOKUPUSER_SUCCESS, { userlist: data })
        } catch (e) {
            commit(types.FETCH_LOOKUPUSER_FAILURE)
        }
    },


    updateLookup({ commit }, payload) {
        commit(types.UPDATE_LOOKUP, payload)
    },
    updateUserLookup({ commit }, payload) {
        commit(types.UPDATE_LOOKUPUSER, payload)
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