import router from './router'
import store from './vuex'
import localforage from "localforage";

localforage.config({
    driver: localforage.LOCALSTORAGE,
    storeName: 'wereading'
})

window.axios = require('axios');
// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = require('vue');
Vue.component('app', require('./components/App.vue').default);
Vue.component('navigation', require('./components/Navigation.vue').default);

// On page load -> fetch user else re
store.dispatch('auth/setToken').then(() => {
    store.dispatch('auth/fetchUser').catch(() => {
        store.dispatch('auth/clearAuth')
        router.replace({ name: 'login' })
    })
}).catch(() => store.dispatch('auth/clearAuth'))

const app = new Vue({
    el: '#app',
    router: router,
    store: store
});
