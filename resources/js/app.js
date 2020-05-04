import Vue from 'vue';
import Router from './Route';
import App from './App.vue';
import Toaster from 'v-toaster'
import 'v-toaster/dist/v-toaster.css'
import VueChatScroll from 'vue-chat-scroll'
import VuePageTransition from 'vue-page-transition'


Vue.use(VueChatScroll);
Vue.use(VuePageTransition);

import Echo from 'laravel-echo';

Vue.use(Toaster, {timeout: 2000});

new Vue({
    el:'#app',
    render: h => h(App),
    router: Router
});
