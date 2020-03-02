const path = require('path');

module.exports = {
  entry: './src/main.js',
  output:{
    path: __dirname + '/js',
    filename: 'main.js'
  },
  module: {
    rules: [
      {
        test: /\.css$/i,
        use: ['style-loader', 'css-loader'],
      },
    ],
  },
};