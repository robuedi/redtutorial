
// I. Installation
// npm init
// npm install
// npm i --save-dev webpack
// npm i --save-dev webpack-cli
// npm i --save-dev @babel/core @babel/preset-env @babel/register

// II. Modules
// npm i --save-dev node-sass
// npm i --save-dev css-loader
// npm i --save-dev sass-loader
// npm i --save-dev babel-loader

//for svg to font
// npm i --save-dev postcss-loader
// npm i --save-dev iconfont-webpack-plugin


// III. Plugins
// npm i --save-dev browser-sync
// npm i --save-dev browser-sync-webpack-plugin
// npm i --save-dev mini-css-extract-plugin
// npm i --save-dev optimize-css-assets-webpack-plugin

// this are specifically for IE
// npm install -g --save-dev babel-polyfill
// npm install -g --save isomorphic-fetch

import path                     from 'path'; //request to node core module (no install needed)
import BrowserSyncPlugin        from 'browser-sync-webpack-plugin';
import MiniCssExtractPlugin     from 'mini-css-extract-plugin';
import OptimizeCSSAssetsPlugin  from 'optimize-css-assets-webpack-plugin';
import IconfontWebpackPlugin    from 'iconfont-webpack-plugin';


// IV svg to font
// npm i --save-dev postcss-loader
// npm i --save-dev iconfont-webpack-plugin

// FINAL
// webpack --watch

module.exports = {
    //Possible values for mode are: none, development or production(default).
    mode: 'production',
    entry: {
//         //the left property will also be used for the bundle location/name
//         // 'js/bundle.min.js':  ['babel-polyfill', 'isomorphic-fetch', './resources/js/index.js'],
        'css/bundle':                 './resources/sass/app.scss',
    },
    output: {
        //set the path and name depending on the entry property name
        path: path.resolve(__dirname, './public/assets/'),
        filename: '[name]'
    },
    optimization: {
        minimizer: [new OptimizeCSSAssetsPlugin({})],
    },
    module: {
        rules : [
            //To compile SASS files
            {
                test: /\.s?[ac]ss$/,
                use: [
                    {
                        loader: MiniCssExtractPlugin.loader},
                    {
                        loader: 'css-loader',
                        options: {
                            url: false,
                            sourceMap: false
                        }
                    },
                    // {
                    //     loader: 'postcss-loader',
                    //     options: {
                    //         plugins: (loader) => [
                    //             // Add the plugin
                    //             new IconfontWebpackPlugin(loader)
                    //         ]
                    //     }
                    // },
                    { loader: 'sass-loader', options: { sourceMap: false } }
                ],
            },
            //To compile JS ES6 files
            {
                test: /\.js$/,
                exclude: /node_modules/,
                loader: 'babel-loader',
                query: {
                    presets: ['@babel/preset-env'],
                }
            }
        ]
    },
    plugins: [
        //this will refresh the resources (js, css) will modifying them
        new BrowserSyncPlugin({
            host: 'localhost',
            proxy: 'https://dev.redtutorial.com',
            port: 3000,
        }),
        new MiniCssExtractPlugin({ // define where to save the file
            filename: '[name].min.css',
        })
    ]
};
