import Api from "./Api";

export default {
  async index(params = null) {
    return Api().get(`api/notifications`, { params: params });
  },
  async destroy(notification, params = null){
    return Api().delete(`api/notifications/${notification}`, params);
  },
  async markAllAsRead(params = null){
    return Api().post(`api/notifications/mark-all-as-read`, params);
  },
}