// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
window.$ = require('jquery');

require('bootstrap');

$(document).ready(function() {
    $('[data-href]').click(function(event){
        window.location = $(this).data('href');
    });
});