var React = require('react');

var StudentRow = React.createClass({
    handleDeleteClick: function(e) {
        e.preventDefault();

        this.props.onRemoveStudent();
    },

    getFullName: function() {
        return this.props.enrollment.firstName+' '+this.props.enrollment.lastName
    },

    render: function () {
        return (
            <tr>
                <td>{this.props.enrollment.email}</td>
                <td>{this.getFullName()}</td>
                <td>{this.props.enrollment.enrolledAt}</td>
                <td>
                    <a href="#" onClick={this.handleDeleteClick}>X</a>
                </td>
            </tr>
        )
    }
});

module.exports = StudentRow;
