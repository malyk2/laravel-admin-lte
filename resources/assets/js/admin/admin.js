import './bootstrap.js';
import App from './App';
import BootstrapVue from 'bootstrap-vue'
import router from './routes';

Vue.use(BootstrapVue);

new Vue({
	el: '#app',
    template: '<App/>',
	router,
    components: {
        App
    }
});