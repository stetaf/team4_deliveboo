/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const app = new Vue({
    el: '#app',
    data() {
        return {
            results: [],
            types: [],
            filter: 0,
            filtered_results: {},
            searched: false
        }
    },
    methods: {
        getResults(page = 1) {
            const url = '/api/restaurants/filter/' + this.filter + '?page=' + page;

            axios.get(url)
                .then(response => {
                    this.filtered_results = response.data;
                })
                .catch(errors => {
                    console.error("Something went wrong: " + errors);
                });
        },
        filterBy(id) {
            this.filter = id;
            this.searched = true;
            this.getResults();
        }
    },
    mounted: function() {
        const restaurants = axios.get('/api/restaurants');
        const ctypes = axios.get('/api/types');

        axios.all([ctypes, restaurants])
            .then(axios.spread((...responses) => {
                this.types = responses[0].data;
                this.results = responses[1].data.data;
            }))
            .catch(errors => {
                console.error("Something went wrong: " + errors);
            })
    }
})