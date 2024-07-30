import mutations from "./mutations";
import actions from "./actions";
import getters from "./getters";

const state = {
  autenticado: false,
  usuario: null,
}

export default {
  namespaced: true,
  state,
  mutations,
  getters,
  actions
}