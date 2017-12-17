const path = require('path');
const webpack = require('webpack');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const port = process.env.PORT || 7000;
const publicPath = `http://localhost:${port}/`;

module.exports = {
  devtool: 'cheap-module-source-map',

  entry: [
    'react-hot-loader/patch',
    `webpack-dev-server/client?${publicPath}`,
    'webpack/hot/only-dev-server',
    './src/index'
  ],

  output: {
    path: path.join(__dirname, 'dist'),
    filename: 'bundle.js'
  },

  plugins: [
    new webpack.HotModuleReplacementPlugin(),
    new HtmlWebpackPlugin({
      filename: 'index.html',
      template: path.resolve(__dirname, './index.dev.html'),
      inject: true
    })
  ],
  // module: {
  //   rules: [
  //     {
  //       test: /\.css$/,
  //       use: [
  //         'style-loader',
  //         {
  //           loader: 'css-loader',
  //           options: { importLoaders: 1 }
  //         },
  //         'postcss-loader'
  //       ]
  //     }
  //   ]
  // },

  devServer: {
    port,
    publicPath,
    hot: true,
    inline: true,
    stats: {
      colors: true
    },
    historyApiFallback: true
  }
};
