/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: Axios } = require('axios');
const { result } = require('lodash');
require('./bootstrap');

var Vue = require('vue');
var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);
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
                [ ],
                0
            ],
            cart_total: 0,
            qty: 0
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
        addToCart(id, item, action) {
            let qty_field = document.querySelector('#qty' + item.id);

            (action == 1) ? this.qty = parseInt(document.querySelector('#qty' + item.id).value) : this.qty = 1;

            if (this.qty > 0) {
                if (this.cart[1].length > 0) {
                    let already_there = false;

                    for (let i = 0; i < this.cart[1].length; i++) {
                        if (item.name == this.cart[1][i]['name']) {
                            already_there = true;
                            (this.qty == 1) ? this.cart[1][i]['quantity'] += 1 : this.cart[1][i]['quantity'] += this.qty;
                        }
                    }
                    (already_there) ? '' : this.addItem(item, this.qty);
                } else {
                    this.addItem(item, this.qty);
                    this.cart[0]['rest_id'] = id;
                }

                (qty_field) ? qty_field.value = 0 : '';

                (action == 0) ? '' : this.animateCart();
                localStorage.setItem('cart_products', this.cart[2]);
                this.calculateSubtotal();
            } else {
                const alert = document.querySelector('.cart_error');

                alert.classList.remove('d-none');
                alert.classList.add('fade-in');

                setTimeout(function() {
                  alert.classList.remove('fade-in');
                  alert.classList.add('d-none');
                }, 2000);
            }
        },
        addItem(item, qty = 1) {
            const info = {
                'id'   : item.id,
                'name' : item.name,
                'image': item.image,
                'price': item.price,
                'quantity'  : qty
            };

            this.cart[1].push(info);
            localStorage.setItem('cart_products', this.cart[2]);
        },
        removeItem(item) {
            for (let i = 0; i < this.cart[1].length; i++) {
                if (item.name == this.cart[1][i]['name']) {
                    if ((this.cart[1][i]['quantity'] - 1) == 0) {
                        this.cart[1].splice(i, 1);
                    } else {
                        this.cart[1][i]['quantity'] -= 1;
                    }
                }
            }
            localStorage.setItem('cart_products', this.cart[2]);
            this.calculateSubtotal();
        },
        clearItem(item) {
            for (let i = 0; i < this.cart[1].length; i++) {
                if (item.name == this.cart[1][i]['name']) {
                    this.cart[1].splice(i, 1);
                }
            }
            localStorage.setItem('cart_products',this.cart[2]);
            this.calculateSubtotal();
        },
        calculateSubtotal() {
            this.cart_total = 0;
            this.cart[2] = 0;

            this.cart[1].forEach(item => {
                this.cart_total += parseFloat(item.price) * item.quantity;
                this.cart[2] += item.quantity;
            });

            this.cart_total.toFixed(2);

            localStorage.setItem('cart_products',this.cart[2]);
            localStorage.setItem('cart', JSON.stringify(this.cart));
        },
        addQty(id) {
            let input = document.querySelector('#qty' + id);
            let valore = parseInt(input.value);

            ((valore + 1) > 99) ? input.value = 99 : input.value = valore + 1;
        },
        lowerQty(id) {
            let input = document.querySelector('#qty' + id);

            ((input.value - 1) <= 0) ? input.value = 0 : input.value -= 1;
        },
        animateCart() {
            const alert = document.querySelector('.cart_alert');

            alert.classList.remove('d-none');
            alert.classList.add('fade-in');

            setTimeout(function() {
              alert.classList.remove('fade-in');
              alert.classList.add('d-none');
            }, 2000);
        },
        getFileName() {
            filename = event.target.files;
            document.querySelector('#image_name').innerHTML = 'File: ' + filename[0]['name'];
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

            if (localStorage.getItem("cart") != null) {
                if (cart[0].rest_id == rest_id) {
                    this.cart = cart;
                    this.calculateSubtotal();
                    this.cart[2] = parseInt(localStorage.getItem('cart_products'));
                }
            }
        }

    }
})
