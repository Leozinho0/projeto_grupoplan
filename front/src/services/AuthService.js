import Api from "./Api";

export default {
  async login(form){
    await Api().get('/sanctum/csrf-cookie');
  	return await Api().post("login", form);
  },

  async register(form){
    await Api().get('/sanctum/csrf-cookie');
  	return await Api().post("register", form);
  },

  async logout(){
  	return await Api().post("logout");
  },
}