import Vue from 'vue'
import Vuex from 'vuex'
import * as types from './mutation-types'

import camelCase from 'lodash/camelCase'
import upperFirst from 'lodash/upperFirst'

Vue.use(Vuex)

// Load store modules dynamically.
const requireContext = require.context('~/modules/', true, /store\/.*index.js$/)

const modules = requireContext
    .keys()
    .map(file => [
        file.replace(/(^.\/)|(\.js$)/g, '').replace('/store/index', ''),
        requireContext(file)
    ])
    .reduce((modules, [name, module]) => {
        if (module.namespaced === undefined) {
            module.namespaced = true
        }
        return {...modules, [name]: module }
    }, {})

// state
export const state = {
    sideBarOpen: false,
    menu: null,
    menuname: null,
    data: null,
}


export const getters = {
        sideBarOpen: state => state.sideBarOpen,
        menu: state => state.menu,
        menuname: state => state.menuname,
        data: state => state.data,
    }
    // mutations
export const mutations = {
    [types.FETCH_SIDEBAR](state) {
        state.sideBarOpen = !state.sideBarOpen
    },
    [types.FETCH_MENU_SUCCESS](state, { menu }) {
        state.menu = menu
    },
    [types.UPDATE_MENU](state, { menu }) {
        state.menu = menu
    },
    [types.UPDATE_MENUNAME](state, { menuname }) {
        state.menuname = menuname
    },
    [types.UPDATE_DATA](state, { data }) {
        state.data = data
    },
}
export const actions = {
        toggleSidebar({ commit }) {
            commit(types.FETCH_SIDEBAR)
        },

        Menu({ commit }, payload) {

            commit(types.UPDATE_MENU, payload)
        },
        MenuName({ commit }, payload) {
            commit(types.UPDATE_MENUNAME, payload)
        },
        Data({ commit }, payload) {
            commit(types.UPDATE_DATA, payload)
        },
    }
    // export default new Vuex.Store({
    //     modules,
    // modulesInside

// state: {

//     sideBarOpen: false
// },
// getters: {
//     sideBarOpen: state => {
//         return state.sideBarOpen
//     }
// },
// /* Aside Mobile */
// mutations: {
//     toggleSidebar (state) {
//         state.sideBarOpen = !state.sideBarOpen
//     }
// },
// action:{
//     toggleSidebar(context) {
//         context.commit('toggleSidebar')
//     }
// }
// })

export default new Vuex.Store({
    namespaced: true,
    modules,
    state,
    actions,
    getters,
    mutations
});