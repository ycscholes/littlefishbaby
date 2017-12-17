const webpack = require('webpack');
const path = require('path');
const basePath = path.resolve(process.cwd());

module.exports = {
  context: basePath,

  module: {
    rules: [
      {
        test: /\.jsx?$/,
        exclude: /node_modules/,
        use: 'babel-loader'
      },
      {
        test: /\.(?:ico|gif|png|jpg|jpeg|webp)$/,
        loader: 'url-loader'
      },
      {
        test: /\.(?:ico|gif|png|jpg|jpeg|webp)$/,
        loader: 'url-loader',
        options: {
          limit: 1024,
          name: 'img/[name].[ext]'
        }
      },
      {
        test: /.(ttf|otf|eot|svg|woff(2)?)(\?[a-z0-9]+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]',
              outputPath: 'fonts/'
            }
          }
        ]
      }
    ]
  },

  resolve: {
    extensions: ['.js', '.jsx'],
    alias: {
      features: `${basePath}/src/features`,
      utils: `${basePath}/src/utils`,
      request: `${basePath}/src/utils/request.js`
    }
  }
};
