const merge = require('webpack-merge');
const common = require('./webpack.common.js');
const path = require('path');

module.exports = merge(common, {
    mode: 'production',
    output: {
        path: path.resolve(__dirname, '../assets_dist/re7'),
        publicPath: '/front-wordpress/wp-content/themes/unt/assets_dist/re7/'
    },
});