import Vue from 'vue';
import Vuex from 'vuex';
import createPersistedState from 'vuex-persistedstate';

import auth from "@/store/auth";

import Vuetify from '@/plugins/vuetify';

Vue.use(Vuex)

export default new Vuex.Store({
  plugins:[
      createPersistedState({
        key: 'projeto_grupoplan',
        storage: window.localStorage,
      })
  ],
  state: {
    sidebar_status: null,
  },
  getters: {
    sidebar_status: state => state.sidebar_status,
  },
  mutations: {
    SIDEBAR_TOGGLE(state){
      state.sidebar_status = !state.sidebar_status;
    },
  },
  actions: {
  },
  modules: {
    auth
  }
})
