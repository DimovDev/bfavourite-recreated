
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



import $ from 'jquery';

window.$ = window.jQuery = $; 
var jQuery = $;

import 'jquery-ui/ui/widgets/autocomplete.js';
import 'jquery-ui/ui/widgets/datepicker.js';


import {MediaLib, MediaLibPagination, MediaLibField}  from './medialib.classes.js';


window.MediaLibField = MediaLibField;
window.MediaLib = MediaLib;

import popper from 'popper.js';
window.popper = popper;

import Prism from 'prismjs';
window.Prism = Prism;

/* Prism.plugins.NormalizeWhitespace.setDefaults({
    'remove-trailing': true,
    'remove-indent': true,
    'left-trim': true,
    'right-trim': true,
    'break-lines': 60
}); */


/* Bootstrap 4.0 */
import 'bootstrap';

/* Laravel Bootstrap JS */
import './bootstrap';


/* window.Vue = require('vue');
 */
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/* Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 */
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/* const app = new Vue({
    el: '#app'
});
 */