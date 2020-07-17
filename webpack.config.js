const path = require('path');
require("@babel/polyfill");

module.exports = {
  mode: "development",
  entry: ["@babel/polyfill", "./src/js/script.js"],
  output: {
    filename: "index.js",
    path: path.resolve(__dirname, "./js")
  },
  module: {
    rules: [
      {
        test: /\.js$/, 
        exclude: /node_modules/, 
        use: ['babel-loader']
      }
    ]
  }
}