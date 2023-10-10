import 'jquery';
import 'popper.js';
import 'chart.js';
import 'bootstrap'; // Asegúrate de que bootstrap esté importado
import 'bootstrap/dist/css/bootstrap.css';
import Alpine from 'alpinejs';
window.bootstrap = require('bootstrap');

window.Chart = require('chart.js');

const app = new Vue({
    el: '#app',
});

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});