import axios from "axios";
import router from "@/router";

function handleError(error){
  const code = error.response ? error.response.status : 0;

  switch(code){
    case 401: {
      router.push({ name:'Logout' });
      break;
    }
  }
  return Promise.reject(error);
}
export default () => {
  const Api = axios.create({
    baseURL: process.env.VUE_APP_BASEAPI,
    withCredentials: true,
    withXSRFToken: true,
    headers: {
      'Accept': 'application/json',
      'Content-Type': 'application/json',
    }
  });

  Api.interceptors.response.use(function (response) {
    return response;
  }, handleError);

  return Api
}
