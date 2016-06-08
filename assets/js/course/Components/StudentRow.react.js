var React = require('react');

var StudentRow = React.createClass({
    getFullName: function() {
        return this.props.enrollment.firstName+' '+this.props.enrollment.lastName
    },

    render: function () {
        return (
            <tr>
                <td>{this.props.enrollment.email}</td>
                <td>{this.getFullName()}</td>
            </tr>
        )
    }
});

module.exports = StudentRow;
