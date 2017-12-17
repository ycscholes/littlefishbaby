const webpack = require('webpack');
const merge = require('webpack-merge');
const WebpackDevServer = require('webpack-dev-server');
const baseConfig = require('./webpack.config.base.js');
const devConfig = require('./webpack.config.dev.js');

function runDevServer() {
  let compiler = webpack(merge.smart(baseConfig, devConfig));
  let { devServer } = devConfig;
  let server = new WebpackDevServer(compiler, devServer);
  let { port } = devServer;

  server.listen(port, 'localhost', function (err) {
    if (err) {
      console.log(err);
    }
    console.log('WebpackDevServer listening at localhost:', port);
  });
}

runDevServer();

