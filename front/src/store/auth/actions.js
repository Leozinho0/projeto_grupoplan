import AuthService from "@/services/AuthService";

const signIn = async ({commit}, params) => {
  return new Promise(async (resolve, reject) => {
    try {
      const response = await AuthService.login(params);
  
      commit('SET_USUARIO', response.data.data);
      commit('SET_AUTENTICADO');

      resolve();
    } catch (e) {
      reject(e);
    }
  });
}

const signOut = async ({commit}) => {
  return new Promise(async (resolve, reject) => {
    try {
      commit('DELETE_AUTENTICADO');
      commit('DELETE_USUARIO');
      
      window.localStorage.removeItem('intimater');

      resolve();
    } catch(e) {
      reject(e);
    }
  });
}

export default {
  signIn,
  signOut,
}