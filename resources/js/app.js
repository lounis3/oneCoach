require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('jugador', require('./components/Jugador').default);

const app = new Vue({
    el: '#app',
});
