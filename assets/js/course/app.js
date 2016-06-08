var alerter = require('./alerter');

jQuery(document).ready(function() {
    $('#course_edit .js-alert').on('click', function() {
        alerter.sendAlert('Yay');
    });
});
