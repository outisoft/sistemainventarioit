import './bootstrap';
import 'bootstrap'; // Asegúrate de que bootstrap esté importado
import 'toastr/build/toastr.css';
import Alpine from 'alpinejs';
import toastr from 'toastr';
import 'toastr/toastr.scss';

// Agrega las siguientes líneas para importar Toastr
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