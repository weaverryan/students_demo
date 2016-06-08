var React = require('react');

var StudentList = React.createClass({
    render: function () {
        return (
            <table className="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
            </table>
        );
    }
});

module.exports = StudentList;
