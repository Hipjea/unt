const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const path = require('path');

module.exports = merge(common, {
    mode: 'development',
    devtool: 'inline-source-map',
    output: {
        path: path.resolve(__dirname, '../assets_dist/dev'),
        publicPath: '/wp-content/themes/unt/assets_dist/dev/'
    },
});