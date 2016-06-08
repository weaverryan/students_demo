var React = require('react');
var StudentRow = require('./StudentRow.react');

var StudentList = React.createClass({
    getInitialState: function() {
        return {
            'enrollments': this.props.enrollments
        }
    },

    removeStudent(id) {
        var matchedKey;
        var enrollments = this.state.enrollments;

        $.each(enrollments, function(key, student) {
            if (student.id == id) {
                matchedKey = key;
            }
        });

        var self = this;
        var url = enrollments[matchedKey].url;
        $.ajax({
            url: url,
            method: 'DELETE',
            'success': function() {
                enrollments.splice(matchedKey, 1);

                self.setState({
                    'enrollments': enrollments
                });
            }
        });
    },

    render: function () {
        var self = this;
        var rows = this.props.enrollments.map(function(enrollment) {
            return (
                <StudentRow
                    enrollment={enrollment}
                    key={enrollment.id}
                    onRemoveStudent={self.removeStudent.bind(self, enrollment.id)}
                />
            );
        });

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {rows}
                </tbody>
            </table>
        );
    }
});

module.exports = StudentList;
