import './bootstrap.js';
import App from './App'
import router from './routes';

new Vue({
	el: '#admin-app',
    template: '<App/>',
	router : router,
    components: {
        App
    }
});