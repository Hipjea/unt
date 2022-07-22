const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    entry: {
        bootstrap: './assets/js/bootstrap.js',
        fontawesome: './assets/js/fontawesome.js',
        app: './assets/js/app-main.js',
        notice: './assets/js/app-notice.js',
        resultats: './assets/js/app-resultats.js'
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, 'assets_dist'),
        publicPath: '/wp-content/themes/unt/assets_dist/',
        pathinfo: false
    },
    module: {
        rules: [
            {
                test: /\.m?js$/,
                exclude: /(node_modules)/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env']
                    }
                }
            },
            {
                test: /\.(sass)$/,
                use: [
                    {
                        // Adds CSS to the DOM by injecting a `<style>` tag
                        loader: 'style-loader'
                    },
                    {
                        loader: MiniCssExtractPlugin.loader,
                        options: {
                            esModule: false
                        }
                    },
                    {
                        // Interprets `@import` and `url()` like `import/require()` and will resolve them
                        loader: 'css-loader',
                    },
                    {
                        // Loader for webpack to process CSS with PostCSS
                        loader: 'postcss-loader',
                        options: {
                            postcssOptions: {
                                plugins: [
                                    [
                                        "autoprefixer",
                                        {
                                            // Options
                                        },
                                    ],
                                ],
                            },
                        },
                    },
                    {
                        loader: 'sass-loader'
                    }
                ],
                sideEffects: true
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                type: 'asset/resource'
            },
            {
                test: /\.(ttf|eot|svg|woff|woff2)$/,
                type: 'asset/inline'
            }
        ]
    },
    plugins: [
        new CopyWebpackPlugin(
            { 
                patterns: [
                    { from: 'assets/images', to: 'images' },
                    { from: 'assets/fonts', to: 'fonts' },
                    { from: 'assets/js/toCopy', to: 'js' },
                    { from: 'node_modules/jquery/dist', to: 'vendors/jquery' },
                    { from: 'node_modules/jquery-ui-dist', to: 'vendors/jquery-ui' },
                    { from: 'node_modules/jstree/dist', to: 'vendors/jstree' },
                    { from: 'node_modules/owl.carousel/dist', to: 'vendors/owlcarousel' },
                    { from: 'node_modules/css-vars-ponyfill/dist', to: 'vendors/ponyfill' },
                    { from: 'node_modules/unpoly/', to: 'vendors/unpoly' },
                ]
            }
        ),
        new MiniCssExtractPlugin()
    ]
};