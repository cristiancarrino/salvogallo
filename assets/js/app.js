// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
window.$ = require('jquery');

require('bootstrap');
// require('select2');
// require('bootstrap4-notify');

$(document).ready(function() {
    // $('[data-widget="select2"]').select2();
    $('[data-toggle="tooltip"]').tooltip();
});
