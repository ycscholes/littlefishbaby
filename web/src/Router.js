import React from 'react';
import { BrowserRouter as Router, Route } from 'react-router-dom';
import DevTools from 'mobx-react-devtools';
import Home from './Home';
import Login from 'features/login';

export default () => (
  <Router>
    <div>
      <Route exact path="/" component={Home} />
      <Route path="/login" component={Login} />
      <DevTools />
    </div>
  </Router>
);
