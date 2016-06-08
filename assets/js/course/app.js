var React = require('react');
var ReactDOM = require('react-dom');
var CourseApp = require('./Components/CourseApp.react');


var course = {
    name: 'Test Course'
};

var enrollments = window.studentEnrollmentDetails;

$(document).ready(function() {
    ReactDOM.render(<CourseApp course={course} enrollments={enrollments} />, document.getElementById('course_edit'));
});
