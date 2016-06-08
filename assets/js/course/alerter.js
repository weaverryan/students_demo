

var alerter = {
    initialize: function() {
        $('#course_edit .js-alert').on('click', $.proxy(this._handleSendAlertClick, this));
    },

    _handleSendAlertClick: function(e) {
        e.preventDefault();

        this.sendAlert('Yay');
    },

    sendAlert: function(msg) {
        alert(msg);
    }
};

module.exports = alerter;
