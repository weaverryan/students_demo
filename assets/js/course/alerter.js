
class alerter {
    constructor($wrapper) {
        this.initialize($wrapper);
    }

    initialize($wrapper) {
        this.$wrapper = $wrapper;

        this.$wrapper.on('click', '.js-alert', $.proxy(this._handleSendAlertClick, this));
    }

    _handleSendAlertClick(e) {
        e.preventDefault();

        var message = $(e.currentTarget).data('message');

        var newLink = $(e.currentTarget).clone();
        newLink.data('message', 'Other');
        newLink.html('Other clicky');
        this.$wrapper.append(newLink);

        this.sendAlert(message);
    }

    sendAlert(msg) {
        alert(msg);
    }
}

export default alerter;
