var React = require('react');
var ReactDOM = require('react-dom');
var CourseApp = require('./Components/CourseApp.react');

$(document).ready(function() {
    ReactDOM.render(<CourseApp/>, document.getElementById('course_edit'));
});
