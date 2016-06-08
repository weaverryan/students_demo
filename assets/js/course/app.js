var React = require('react');
var ReactDOM = require('react-dom');
var CourseApp = require('./Components/CourseApp.react');


var course = {
    name: 'Test Course'
};

$(document).ready(function() {
    ReactDOM.render(<CourseApp course={course} />, document.getElementById('course_edit'));
});
