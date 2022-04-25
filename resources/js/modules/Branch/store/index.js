import axios from "axios";
import Cookies from "js-cookie";
import * as types from "./mutation-types";

// state
export const state = {
    list: null,
    branch: null,
};

// getters
export const getters = {
    list: (state) => state.list,
    branch: (state) => state.branch,
};

// mutations
export const mutations = {
    [types.FETCH_BRANCH_SUCCESS](state, { list }) {
        state.list = list;
    },

    [types.FETCH_BRANCH_FAILURE](state) {
        state.list = null;
    },
    [types.UPDATE_BRANCH](state, { list }) {
        state.list = list;
    },
    [types.UPDATE_MYBRANCH](state, { branch }) {
        state.branch = branch;
    },
    [types.LOGOUT](state) {
        state.list = null;
        state.branch = null;
    },
};

// actions
export const actions = {
    async fetchBranch({ commit }, payload) {
        try {
            const { data } = await axios.get("/api/auth/branch", {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                    id: payload.id ? payload.id : "",
                },
            });
            commit(types.FETCH_BRANCH_SUCCESS, { list: data });
        } catch (e) {
            commit(types.FETCH_BRANCH_FAILURE);
        }
    },

    updateBranch({ commit }, payload) {
        commit(types.UPDATE_BRANCH, payload);
    },

    updatemyBranch({ commit }, payload) {
        commit(types.UPDATE_MYBRANCH, payload);
    },
    async logout({ commit }) {
        commit(types.LOGOUT);
    },
};

export default {
    namespaced: true,
    state,
    actions,
    getters,
    mutations,
};
