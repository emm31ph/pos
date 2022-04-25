import axios from 'axios'
import * as types from './mutation-types'


// state
export const state = {
    list: null,
    perm_list: null,
}

// getters
export const getters = {
    list: state => state.list,
    perm_list: state => state.perm_list,
}

// mutations
export const mutations = {
    [types.FETCH_ACL_SUCCESS](state, { list }) {
        state.list = list
    },
    [types.FETCH_ACL_FAILURE](state) {
        state.list = null
    },
    [types.UPDATE_ACL](state, { list }) {
        state.list = list
    },
    [types.FETCH_PERMISSION_SUCCESS](state, { perm_list }) {
        state.perm_list = perm_list
    },
    [types.FETCH_PERMISSION_FAILURE](state) {
        state.perm_list = null
    },
    [types.UPDATE_PERMISSION](state, { perm_list }) {
        state.perm_list = perm_list
    },
    
    [types.LOGOUT](state) {
        state.list = null
        state.perm_list = null 
    },
}


// actions
export const actions = {

    async fetchAcl({ commit }, payload) {
        try {
            const { data } = await axios.get('/api/auth/acl', {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                }
            })
            commit(types.FETCH_ACL_SUCCESS, { list: data })
        } catch (e) {
            commit(types.FETCH_ACL_FAILURE)
        }
    },

    updateAcl({ commit }, payload) {
        commit(types.UPDATE_ACL, payload)
    },
    async fetchPermissions({ commit }, payload) {
        try {
            const { data } = await axios.get('/api/auth/acl', {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                }
            })
            commit(types.FETCH_PERMISSION_SUCCESS, { perm_list: data })
        } catch (e) {
            commit(types.FETCH_PERMISSION_FAILURE)
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