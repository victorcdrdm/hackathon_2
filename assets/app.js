/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import { CountUp } from 'countup.js';
const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');
// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    const wellDone = document.getElementById('well-done');
    const img = document.getElementById('well-done-image')
    const button = document.getElementById('todo-button');

    button.addEventListener("click", () => {
        wellDone.classList.add('d-flex-well');
    })
    wellDone.addEventListener("click", () => {
        wellDone.classList.remove('d-flex-well');
    })

    let userScore = document.getElementById('user-score');
    let score     = userScore.innerHTML;

    const options = {
        separator: ' ',
    };
    let demo = new CountUp('countup', score, options);
    if (!demo.error) {
        demo.start();
    } else {
        console.error(demo.error);
    }

});






//Count up



//Well Done!



