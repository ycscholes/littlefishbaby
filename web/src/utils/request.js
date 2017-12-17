import axios from 'axios';

axios.defaults.baseURL = 'http://littlefishbaby.app/api';
axios.defaults.headers.post['Content-Type'] = 'application/json';

export function setAuthHeader(jwt) {
  window.localStorage._jwt = jwt;

  axios.defaults.headers.common['Authorization'] = `Bearer ${jwt}`;
}

setAuthHeader(window.localStorage._jwt);

export default axios;