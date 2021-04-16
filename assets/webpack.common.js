const path = require('path');
const CopyWebpackPlugin = require('copy-webpack-plugin');

module.exports = {
    entry: {
        'app': './src/app-main.js',
        'notice': './src/app-notice.js',
        'resultats': './src/app-resultats.js',
    },
    output: {
        filename: '[name].js',
        path: path.resolve(__dirname, '../assets_dist'),
        publicPath: '/wp-content/themes/unt/assets/dist/'
    },
    module: {
        rules: [
            {
                test: /\.(scss)$/,
                use: [
                    {
                        // Adds CSS to the DOM by injecting a `<style>` tag
                        loader: 'style-loader'
                    },
                    {
                        // Interprets `@import` and `url()` like `import/require()` and will resolve them
                        loader: 'css-loader'
                    },
                    {
                        // Loader for webpack to process CSS with PostCSS
                        loader: 'postcss-loader',
                        options: {
                            plugins: function () {
                                return [
                                    require('autoprefixer')
                                ];
                            }
                        }
                    },
                    {
                        // Loads a SASS/SCSS file and compiles it to CSS
                        loader: 'sass-loader'
                    }
                ]
            },
            {
                test: /\.(gif|png|jpe?g|svg)$/i,
                use: [
                    'file-loader',
                    {
                        loader: 'image-webpack-loader',
                        options: {
                            bypassOnDebug: true, // webpack@1.x
                            disable: true // webpack@2.x and newer
                        }
                    }
                ]
            }
        ]
    },
    plugins: [
        new CopyWebpackPlugin([
            {from:'src/images',to:'images'},
            {from:'src/scripts/toCopy', to:'scripts'},
            {from:'node_modules/jquery/dist', to:'vendors/jquery'},
            {from:'node_modules/jquery-ui-dist', to:'vendors/jquery-ui'},
            {from:'node_modules/jstree/dist', to:'vendors/jstree'},
            {from:'node_modules/owl.carousel/dist', to:'vendors/owlcarousel'},
            {from:'node_modules/css-vars-ponyfill/dist', to:'vendors/ponyfill'},
        ]),
    ]
};