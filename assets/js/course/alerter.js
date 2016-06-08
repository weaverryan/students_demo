

var alerter = {
    initialize: function() {
        $('#course_edit').on('click', '.js-alert', $.proxy(this._handleSendAlertClick, this));
    },

    _handleSendAlertClick: function(e) {
        e.preventDefault();

        var message = $(e.currentTarget).data('message');

        var newLink = $(e.currentTarget).clone();
        newLink.data('message', 'Other');
        newLink.html('Other clicky');
        $('#course_edit').append(newLink);

        this.sendAlert(message);
    },

    sendAlert: function(msg) {
        alert(msg);
    }
};

module.exports = alerter;
