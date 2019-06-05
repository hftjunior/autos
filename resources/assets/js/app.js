
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'Vuex';
Vue.use(Vuex);
Vue.use(require('vue-moment'));
/**
 * Vuex
 */
const store = new Vuex.Store({
    state:{
        item:{}
    },
    mutations:{
        setItem(state,obj){
            state.item = obj;
        }
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('page-title', require('./components/Title.vue'));
Vue.component('page-grid', require('./components/Grid.vue'));
Vue.component('page-gridsearch', require('./components/GridSearch.vue'));
Vue.component('page-form', require('./components/Form.vue'));
Vue.component('form-select', require('./components/FormSelect.vue'));
Vue.component('form-selectdependent', require('./components/FormSelectDependent.vue'));

Vue.component('modal', require('./components/modal/Modal.vue'));
Vue.component('modal-link', require('./components/modal/ModalLink.vue'));

Vue.component('dashboard-box', require('./components/dashboard/Box.vue'));

const app = new Vue({
    el: '#app',
    store,
    mounted: function(){
        document.getElementById('app').style.display = 'block';
    }
});
