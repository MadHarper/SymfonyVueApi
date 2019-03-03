import Vue from 'vue'
import App from '@/App.vue'
import axios from 'axios'
import router from './router'
import auth from '@/helpers/auth'

//import bootstrap from 'bootstrap'

// import 'bootstrap/dist/css/bootstrap.min.css'
// import 'admin-lte/dist/css/skins/skin-blue.css'
// import 'admin-lte/dist/css/AdminLTE.css'
// import 'admin-lte/dist/css/alt/AdminLTE-bootstrap-social.css'
// import 'admin-lte/dist/css/alt/AdminLTE-fullcalendar.css'
// import 'admin-lte/dist/css/alt/AdminLTE-without-plugins.css'

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.config.productionTip = false;

Vue.prototype.$axios = axios

axios.defaults.baseURL = `http://svue.dev:8055/api/`;

axios.interceptors.response.use(undefined,
    function (err) {
        // решение из интернета
        // if (error.response.status === 401) {
        //     console.log('unauthorized, logging out ...');
        //     auth.logout();
        //     router.replace('/auth/login');
        // }
        // return Promise.reject(error.response);


        return new Promise(function (resolve, reject) {
            if (err.response.status === 401) {
                window.console.log("Произойдет переадресация на страницу логина!");

                //почистим токен в локалсторадже
                auth.clearToken();
                // переадресуем на страницу авторизации
                router.push('login');
            }
    });
});


//axios.defaults.headers.common['X-AUTH-TOKEN'] = 'qwerty';

Vue.use(BootstrapVue)

new Vue({
  router,
  render: h => h(App),
}).$mount('#app')
