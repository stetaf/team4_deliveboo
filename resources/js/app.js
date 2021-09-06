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
            no_results: false,
            cart: [
                { 'rest_id' : 0 },
                [ ]
            ],
            cart_total: 0
        }
    },
    methods: {
        getResults(page = 1) {
            const url = '/api/restaurants/filter/' + this.filter + '?page=' + page;

            axios.get(url)
                .then(response => {
                    this.filtered_results = response.data;
                    (this.filtered_results.data.length == 0) ? this.no_results = true : this.no_results = false;
                })
                .catch(errors => {
                    console.error("Something went wrong: " + errors);
                });
        },
        filterBy(id) {
            this.filter = id;
            this.searched = true;
            this.getResults();
        },
        addToCart(id, item) {
            if (this.cart[1].length > 0) {
                let already_there = false;
                
                for (let i = 0; i < this.cart[1].length; i++) {
                    if (item.name == this.cart[1][i]['name']) {
                        already_there = true;
                        this.cart[1][i]['qty'] += 1;
                    }
                }
                (already_there) ? '' : this.addItem(item);
            } else {
                this.addItem(item);
                this.cart[0]['rest_id'] = id;
            }
            this.calculateSubtotal();
        },
        addItem(item) {
            const info = {
                'name' : item.name,
                'image': item.image,
                'price': item.price,
                'qty'  : 1
            };

            this.cart[1].push(info);
        },
        removeItem(item) {
            for (let i = 0; i < this.cart[1].length; i++) {
                if (item.name == this.cart[1][i]['name']) {
                    ((this.cart[1][i]['qty'] - 1) == 0) ? this.cart[1].splice(i, 1) : this.cart[1][i]['qty'] -= 1;
                }
            }
            this.calculateSubtotal();
        },
        clearItem(item) {
            for (let i = 0; i < this.cart[1].length; i++) {
                if (item.name == this.cart[1][i]['name']) {
                    this.cart[1].splice(i, 1);
                }
            }
            this.calculateSubtotal();
        },
        calculateSubtotal() {
            this.cart_total = 0;

            this.cart[1].forEach(item => {
                this.cart_total += parseFloat(item.price) * item.qty;
            });

            this.cart_total.toFixed(2);

            localStorage.setItem('cart', JSON.stringify(this.cart));
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
        
        let url_path = window.location.pathname;
        if (url_path.includes('restaurant')) {
            const cart = JSON.parse(localStorage.getItem('cart'));
            const rest_id = url_path.match(/\d+/)[0];
            
            if (cart[0].rest_id == rest_id) {
                this.cart = cart;
                this.calculateSubtotal();
            }
        }
    }
})