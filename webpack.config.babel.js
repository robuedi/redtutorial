
// I.
// npm install --save-dev webpack
// npm install --save-dev webpack@4
// npm install --save-dev webpack-cli
// npm install --save-dev css-loader
// npm install --save-dev sass-loader
// npm install --save-dev babel-loader
// npm install --save-dev json-loader

// this are specifically for IE
// npm install --save-dev babel-polyfill
// npm install --save isomorphic-fetch

import path               from 'path'; //request to node core module (no install needed)

// II.
//npm install --save-dev browser-sync-webpack-plugin
import BrowserSyncPlugin  from 'browser-sync-webpack-plugin';

// III.
//npm install --save-dev mini-css-extract-plugin
import MiniCssExtractPlugin  from 'mini-css-extract-plugin';

// FINAL
// webpack --watch

module.exports = {
    entry: {
        //the left property will also be used for the bundle location/name
        'js/bundle.min.js':  ['babel-polyfill', 'isomorphic-fetch', './resources/js/nms/index.js'],
        'css/bundle':                 './resources/sass/app.scss',
    },
    output: {
        //set the path and name depending on the entry property name
        path: path.resolve(__dirname, './public/assets/'),
        filename: '[name]'
    },
    optimization: {
        splitChunks: {
            name: true
        },
        minimize: false
    },
    module: {
        rules : [
            //To compile SASS files
            {
                test: /\.s?[ac]ss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    { loader: 'css-loader', options: { url: false, sourceMap: true } },
                    { loader: 'sass-loader', options: { sourceMap: true } }
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
            proxy: 'dev.redtutorial.com',
            port: 3000,
        }),
        new MiniCssExtractPlugin({ // define where to save the file
            filename: '[name].min.css',
        })
    ]
};
