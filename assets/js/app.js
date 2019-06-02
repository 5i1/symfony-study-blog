/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.scss');

import 'popper.js';
import 'bootstrap';
import 'holderjs';

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

// Variables reusable.
let $window = $(window);
let $nav = $('.navigation');

/*
 * Script for navigation top fixed.
 */
let previousTop = 0;

$window.scroll(function() {
    if (992 < $(this).width()) {
        let s = $nav.height();
        let i = $(this).scrollTop();
        i < previousTop ? 0 < i && $nav.hasClass('is-fixed') ? $nav.addClass('is-visible') : $nav.removeClass('is-visible is-fixed') : i > previousTop && ($nav.removeClass('is-visible'), s < i && !$nav.hasClass('is-fixed') && $nav.addClass('is-fixed')), previousTop = i;
    }
});

