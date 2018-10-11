const ExtractTextPlugin = require("extract-text-webpack-plugin");
const path = require('path');

module.exports = {
  entry: [
    './client/index.js'
  ],
  module: {
    loaders: [{
      exclude: /node_modules/
    }]
  },
  resolve: {
    extensions: ['*', '.js']
  },
  output: {
    path: path.resolve(__dirname, 'public'),
    publicPath: '/',
    filename: 'bundle.js'
  },
  plugins: [
       new ExtractTextPlugin("[name].css")
   ],
};
