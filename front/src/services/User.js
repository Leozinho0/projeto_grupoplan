import Api from "./Api";

export default {
  async index(params = null) {
    return Api().get(`/api/users`, { params: params });
  },
  async show(uuid) {
    return Api().get(`/api/users/${uuid}`);
  },
  async update(uuid, params = null){
    return Api().post(`/api/users/${uuid}`, params, { headers: {
      'Content-Type': 'multipart/form-data'
    }});
  },
}