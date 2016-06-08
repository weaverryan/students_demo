var React = require('react');
var StudentList = require('./StudentList.react');

var CourseApp = React.createClass({
  render: function() {
      return (
          <div>
              <h1>{this.props.course.name}</h1>
                <StudentList enrollments={this.props.enrollments} />
          </div>
      );
  }
});

module.exports = CourseApp;
