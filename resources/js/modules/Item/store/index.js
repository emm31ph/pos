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
    [types.FETCH_ITEM_SUCCESS](state, { list }) {
        state.list = list;
    },
    [types.FETCH_ITEM_FAILURE](state) {
        state.list = null;
    },
    [types.UPDATE_ITEM](state, { list }) {
        state.list = list;
    },
    [types.LOGOUT](state) {
        state.list = null;
    },
};

// actions
export const actions = {
    async fetchItem({ commit }, payload) {
        try {
            const { data } = await axios.get("/api/auth/item", {
                params: {
                    trnmode: payload.trnmode,
                    trntype: payload.trntype,
                },
            });
            commit(types.FETCH_ITEM_SUCCESS, { list: data });
        } catch (e) {
            commit(types.FETCH_ITEM_FAILURE);
        }
    },

    updateItem({ commit }, payload) {
        commit(types.UPDATE_ITEM, payload);
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
