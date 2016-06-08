var React = require('react');

var CourseApp = React.createClass({
  render: function() {
      return (
          <div>
              <h1>{this.props.course.name}</h1>
          </div>
      );
  }
});

module.exports = CourseApp;
