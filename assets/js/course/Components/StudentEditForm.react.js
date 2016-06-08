var React = require('react');

var StudentEditForm = React.createClass({
    handleFieldChange: function(e) {
        this.props.onUpdateEnrollmentField(e.target.name, e.target.value);
    },

    render: function () {
        return (
            <div>
                <input type="text" name="email" value={this.props.enrollment.email} onChange={this.handleFieldChange} />
            </div>
        )
    }
});

module.exports = StudentEditForm;
