import Vue from 'vue';
import App from '@/pages/headlines';

new Vue({
    //el: '#app', => old version
    /*render(h) {
        return h(App);
    }*/ //=> old style
    render: (h) => h(App),
}).$mount('#headline');

