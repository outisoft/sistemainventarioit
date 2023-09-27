import './bootstrap';
import 'bootstrap'; // Asegúrate de que bootstrap esté importado
import 'toastr/build/toastr.css';
import Alpine from 'alpinejs';
require('./bootstrap');

// Agrega las siguientes líneas para importar Toastr
import toastr from 'toastr';
window.toastr = toastr;

const app = new Vue({
    el: '#app',
});

window.Alpine = Alpine;

Alpine.start();

// resources/js/app.js
$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

// resources/js/app.js
window.toastr = require('toastr');

