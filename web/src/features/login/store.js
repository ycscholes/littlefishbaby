import { observable } from 'mobx';
import request, { setAuthHeader } from 'utils/request';

class Store {
  @observable username;
  @observable password;
  @observable errText;
  @observable captchaImg;

  // getCaptchaImg() {
  //   this.captchaImg = `${request.defaults.baseURL}/auth/captcha?${Date.now()}`;
  // }
  login() {
    let { username, password, captcha } = store;

    request
      .post('/auth/login', {
        username,
        password,
        captcha
      })
      .then(resp => {
        if (resp.data) {
          setAuthHeader(resp.data.token);

          request.get('/user');
        }
      })
      .catch(({ response }) => {
        this.errText = response.data.message;

        // if (response.status === 429) {
        //   this.getCaptchaImg();
        // } else {
        //   this.errText = response.data.message;
        // }
      });
  }
  refreshTocken() {
    request.get('/user/tocken_refresh').then((resp) => {
      console.log(resp);
    })
  }
}

const store = new Store();

export default store;
