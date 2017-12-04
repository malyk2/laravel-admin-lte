import './bootstrap.js';
import App from './App';
import BootstrapVue from 'bootstrap-vue'
import router from './routes';
import $ from 'jquery';
import VueResource from 'vue-resource';

Vue.use(BootstrapVue);
Vue.use(VueResource);

let publicPages = ['/pages/login'];

router.beforeEach((to, from, next) => {
    //let authUser = sessionStorage.getItem('authUser');
    //console.log(authUser);
    //console.log('test');
    next();

//    if (authUser) {
//        next();
//    } else {
//        //$http.get('auth.user').then('response' => ());
//        /*$.ajax({
//           url: 'test'
//        })*/;
//        router.push('/pages/login');
//    }
//    //console.log(JSON.parse(sessionStorage.getItem('user')));
//    //console.log(sessionStorage.user);
//    if(publicPages.includes(to.fullPath)) {
//        /*sessionStorage.setItem('user', JSON.stringify({
//            asd: 'zxczxc'
//        }));*/
//        next();
//    } else {
//        router.push('/pages/login');
//    }
});

new Vue({
    el: '#app',
    template: '<App/>',
    router,
    components: {
        App
    },
    created() {
        const postData = {
            grant_type: 'password',
            client_id: 2,
            client_secret: 'JseEQP5nXHFz7MarPWNK5e25owFCWzfgThZ0KXD6',
            username: 'tk@div-art.com',
            password: '111111111'
        };
        this.$http.post('/oauth/token', postData)
                .then(response => {
                    //console.log(response);
                    const headers = {
                        Accept: 'application/json',
                        Authorization: 'Bearer '+ response.body.access_token
                    };
                    //console.log(headers);
                    this.$http.get('/api/user',{headers: headers})
                            .then(response => {
//                                console.log(response);
                            });
                });
    }
});