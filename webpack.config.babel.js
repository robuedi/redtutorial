
// I.
// npm install -g --save-dev webpack
// npm install -g --save-dev webpack@4
// npm install -g --save-dev webpack-cli
// npm install -g --save-dev css-loader
// npm install -g --save-dev sass-loader
// npm install -g --save-dev babel-loader


// this are specifically for IE
// npm install -g --save-dev babel-polyfill
// npm install -g --save isomorphic-fetch

import path               from 'path'; //request to node core module (no install needed)

// II.
//npm install -g --save-dev browser-sync-webpack-plugin
import BrowserSyncPlugin  from 'browser-sync-webpack-plugin';

// III.
//npm install -g --save-dev mini-css-extract-plugin
import MiniCssExtractPlugin  from 'mini-css-extract-plugin';

// FINAL
// webpack --watch

module.exports = {
    entry: {
        //the left property will also be used for the bundle location/name
        'js/bundle.min.js':  ['babel-polyfill', 'isomorphic-fetch', './resources/js/index.js'],
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
