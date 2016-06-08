var React = require('react');
var ReactDOM = require('react-dom');

var Hello = React.createClass({
  render: function() {
    return <h1>Hello</h1>
  }
});

$(document).ready(function() {
    ReactDOM.render(<Hello/>, document.getElementById('course_edit'));
});
