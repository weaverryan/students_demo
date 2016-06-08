var path = require("path");

module.exports = {
    entry: './js/course/app.js',
    output: {
        path: path.resolve(__dirname, '../web/js'),
        filename: 'course.js',
        publicPath: '/js/'
    }
}
