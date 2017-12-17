import React, { Component } from 'react';
import { withRouter, Route } from 'react-router-dom';
import { observer } from 'mobx-react';
import { Button, TextField } from 'material-ui';
import { LoginWrapper, StyledTextField, Row, ErrText } from './style';
import store from './store';
import Dashboard from '../dashboard';

@observer
class LoginForm extends Component {
  keyenter = e => {
    if (e.keyCode === 13) {
      this.login();
    }
  };
  getCaptchaImg() {
    store.getCaptchaImg();
  }
  login() {
    store.login();
  }
  input(e) {
    store[e.target.id] = e.target.value;
  }
  render() {
    store.refreshTocken();
    return (
      <LoginWrapper onKeyUp={this.keyenter}>
        <StyledTextField
          id="username"
          label="用户名"
          value={store.username || ''}
          onInput={this.input}
        />
        <StyledTextField
          id="password"
          label="密码"
          type="password"
          value={store.password || ''}
          onInput={this.input}
        />
        {store.captchaImg && (
          <Row>
            <TextField id="captcha" label="验证码" onInput={this.input} />
            <img src={store.captchaImg} onClick={this.getCaptchaImg} />
          </Row>
        )}
        {store.errText && <ErrText>{store.errText}</ErrText>}
        <Button color="primary" raised onClick={this.login}>
          登录
        </Button>
      </LoginWrapper>
    );
  }
}

export default LoginForm;
