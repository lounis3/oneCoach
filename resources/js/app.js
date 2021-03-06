require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('jugador', require('./components/Jugador').default);
Vue.component('entrenador', require('./components/Entrenador').default);
Vue.component('partido', require('./components/Partido').default);
Vue.component('arbitro', require('./components/Arbitro').default);
Vue.component('medico', require('./components/Medico').default);
Vue.component('estadistica', require('./components/Estadistica').default);
Vue.component('consulta', require('./components/Consulta').default);
Vue.component('equipo', require('./components/Equipo').default);
Vue.component('incidencia', require('./components/Incidencia').default);
const app = new Vue({
    el: '#app',
});
