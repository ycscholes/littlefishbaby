import React, { Component } from 'react';
import { observer } from 'mobx-react';
import Router from './Router';
import './style';

@observer
class App extends Component {
  render() {
    return (
      <Router></Router>
    );
  }
}

export default App;
