var React = require('react');
var StudentEditForm = require('./StudentEditForm.react');

var StudentRow = React.createClass({
    getInitialState: function() {
        return {
            isProcessing: false,
            inEditMode: false
        }
    },

    handleDeleteClick: function(e) {
        e.preventDefault();

        this.setState({
            isProcessing: true
        });
        this.props.onRemoveStudent();
    },

    handleEditClick: function(e) {
        e.preventDefault();

        this.setState({
            inEditMode: true
        });
    },

    getFullName: function() {
        return this.props.enrollment.firstName+' '+this.props.enrollment.lastName
    },

    render: function () {
        var buttons = (
            <div>
                <a href="#" onClick={this.handleDeleteClick}>X</a>
                &nbsp;
                <a href="#" onClick={this.handleEditClick}>Edit</a>
            </div>
        );

        if (this.state.isProcessing) {
            buttons = (
                <span className="fa fa-spinner fa-spin"></span>
            )
        }

        var editWidget;
        if (this.state.inEditMode) {
            editWidget = (
                <td style={{'width': '50%'}}>
                    <StudentEditForm />
                </td>
            );
        }

        return (
            <tr>
                <td>{this.props.enrollment.email}</td>
                <td>{this.getFullName()}</td>
                <td>{this.props.enrollment.enrolledAt}</td>
                <td>
                    {buttons}
                </td>
                {editWidget}
            </tr>
        )
    }
});

module.exports = StudentRow;
