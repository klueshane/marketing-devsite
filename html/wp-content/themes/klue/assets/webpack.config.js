var webpack = require('webpack');
var path = require('path');

module.exports = {
  context: __dirname,
  entry: "./js-source/app.js",
  output: {
    path: __dirname + "/js-built",
    filename: "main.js"
  },
  resolve: {
    root: [
      path.join(__dirname, "..", "..", "node_modules"),
    ],
    extensions: ['', '.js', '.json']
  },
  plugins: [
    new webpack.optimize.DedupePlugin(),
  //   new webpack.optimize.OccurenceOrderPlugin(),
  //   new webpack.optimize.UglifyJsPlugin({ mangle: false, sourcemap: false }),
  ],
};
