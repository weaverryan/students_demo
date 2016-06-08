var path = require("path");

module.exports = {
    entry: './js/course/app.js',
    output: {
        path: path.resolve(__dirname, '../web/js'),
        filename: 'course.js',
        publicPath: '/js/'
    },
    module: {
        loaders: [
            {
                test: /\.js?$/,
                exclude: /node_modules/,
                loader: "babel-loader",
                query: {
                    presets: ['es2015', 'react']
                }
            }
        ]
    },
    devtool: "#inline-source-map"
}
