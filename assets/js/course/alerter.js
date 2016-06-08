

var alerter = {
    initialize: function($wrapper) {
        this.$wrapper = $wrapper;

        this.$wrapper.on('click', '.js-alert', $.proxy(this._handleSendAlertClick, this));
    },

    _handleSendAlertClick: function(e) {
        e.preventDefault();

        var message = $(e.currentTarget).data('message');

        var newLink = $(e.currentTarget).clone();
        newLink.data('message', 'Other');
        newLink.html('Other clicky');
        this.$wrapper.append(newLink);

        this.sendAlert(message);
    },

    sendAlert: function(msg) {
        alert(msg);
    }
};

module.exports = alerter;
