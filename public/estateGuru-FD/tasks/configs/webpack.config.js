
const path = require('path');
const webpack = require('webpack-stream').webpack;
const config = require('./main.config');

let isDevelopment = !process.env.NODE_ENV || process.env.NODE_ENV == "development";

!isDevelopment && console.log('Production')
isDevelopment && console.log('Developing')

let pluginsProd = [
    new webpack.optimize.UglifyJsPlugin({
        compress: {
            screw_ie8: true,
            warnings: false
        },
        output: {
            comments: false
        },
        sourceMap: false,
    }),
    new webpack.optimize.OccurrenceOrderPlugin(true),
    new webpack.optimize.DedupePlugin(),    
];
let pluginsDev = [        
    new webpack.NoErrorsPlugin()
];

let  plugins = isDevelopment ? pluginsProd : pluginsDev;

module.exports = {
    watch:isDevelopment,
    entry:config.paths.entry,
    devtool: isDevelopment ? 'eval' : 'hidden-source-map',
    output: {
        publicPath: '/public/',
        filename: 'bundle.js',
        path: '/public/js/',
    },
    resolve: {
        extensions: ['', '.js', '.jsx','.json']
    },
    plugins: [
        new webpack.DefinePlugin({         
             'process.env': {
                'NODE_ENV': JSON.stringify(process.env.NODE_ENV)
            },          
        }),
        new webpack.ProvidePlugin({           
            'fetch': 'imports?this=>global!exports?global.fetch!whatwg-fetch',
            '$': "jquery",
            
        }),
        ...plugins
    ],
    module: {
        loaders: [{
            test: /\.jsx?$/,
            loaders: ['babel'],
            include: path.join(__dirname, '../../js'),
            exclude: /node_modules/
        },
        {
            test: /jquery-mousewheel/,
            loader: "imports?define=>false&this=>window"
        }, 
        {
            test: /malihu-custom-scrollbar-plugin/,
            loader: "imports?define=>false&this=>window"
        }]
    }
};
