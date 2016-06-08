var React = require('react');

var StudentRow = React.createClass({
    getInitialState: function() {
        return {
            isProcessing: false
        }
    },

    handleDeleteClick: function(e) {
        e.preventDefault();

        this.setState({
            isProcessing: true
        });
        this.props.onRemoveStudent();
    },

    getFullName: function() {
        return this.props.enrollment.firstName+' '+this.props.enrollment.lastName
    },

    render: function () {
        var buttons = (
            <div>
                <a href="#" onClick={this.handleDeleteClick}>X</a>
            </div>
        );

        if (this.state.isProcessing) {
            buttons = (
                <span className="fa fa-spinner fa-spin"></span>
            )
        }

        return (
            <tr>
                <td>{this.props.enrollment.email}</td>
                <td>{this.getFullName()}</td>
                <td>{this.props.enrollment.enrolledAt}</td>
                <td>
                    {buttons}
                </td>
            </tr>
        )
    }
});

module.exports = StudentRow;
