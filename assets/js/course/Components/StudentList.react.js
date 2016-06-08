var React = require('react');
var StudentRow = require('./StudentRow.react');

var StudentList = React.createClass({
    render: function () {
        var rows = this.props.enrollments.map(function(enrollment) {
            return (
                <StudentRow
                    enrollment={enrollment}
                    key={enrollment.id}
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
