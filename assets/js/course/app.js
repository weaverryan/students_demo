var React = require('react');
var ReactDOM = require('react-dom');
var CourseApp = require('./Components/CourseApp.react');


var course = {
    name: 'Test Course'
};
var enrollments = [
    { id: 1, email: 'weaverryan@gmail.com', firstName: 'Ryan' },
    { id: 2, email: 'leannapelham@gmail.com', firstName: 'Leanna' }
];

$(document).ready(function() {
    ReactDOM.render(<CourseApp course={course} enrollments={enrollments} />, document.getElementById('course_edit'));
});
