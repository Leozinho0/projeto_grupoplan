import Api from "./Api";

export default {
  async index(params = null) {
    return Api().get(`/api/trainings`, { params: params });
  },
  async show(uuid) {
    return Api().get(`/api/trainings/${uuid}`);
  },
  async store(params = null){
    return Api().post(`api/trainings`, params);
  },
  async update(uuid, params = null){
    return Api().post(`/api/trainings/${uuid}`, params, { headers: {
      'Content-Type': 'multipart/form-data'
    }});
  },
}