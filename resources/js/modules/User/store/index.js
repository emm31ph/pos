import axios from "axios";
import * as types from "./mutation-types";

// state
export const state = {
    list: null,
};

// getters
export const getters = {
    list: (state) => state.list,
};

// mutations
export const mutations = {
    [types.FETCH_USER_SUCCESS](state, { list }) {
        state.list = list;
    },

    [types.FETCH_USER_FAILURE](state) {
        state.list = null;
    },
    [types.LOGOUT](state) {
        state.list = null;
    },
};

// actions
export const actions = {
    async fetchUser({ commit }, payload) {
        try {
            const { data } = await axios.get("/api/auth/user", {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                    id: payload.id ? payload.id : "",
                },
            });
            commit(types.FETCH_USER_SUCCESS, { list: data });
        } catch (e) {
            commit(types.FETCH_USER_FAILURE);
        }
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
