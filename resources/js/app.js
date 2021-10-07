/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
require("./custom");
window.Vue = require("vue").default;
Vue.use(TableComponent);
import { TableComponent, TableColumn } from 'vue-table-component';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("Profile", require("./components/Profile.vue").default);
Vue.component("category-create", require("./components/category/create.vue").default);
Vue.component("category-index", require("./components/category/index.vue").default);
Vue.component("category-edit", require("./components/category/edit.vue").default);
Vue.component("subcategory-index", require("./components/subcategory/index.vue").default);
Vue.component("subcategory-edit", require("./components/subcategory/edit.vue").default);
Vue.component("product-create", require("./components/product/create.vue").default);
Vue.component("product-index", require("./components/product/index.vue").default);
Vue.component("product-edit", require("./components/product/edit.vue").default);
Vue.component("customer-index", require("./components/customer/index.vue").default);
Vue.component("customer-show", require("./components/customer/show.vue").default);
Vue.component("customer-cart", require("./components/customer/cart.vue").default);
Vue.component("customer-wishlist", require("./components/customer/wishlist.vue").default);
Vue.component("customer-order", require("./components/customer/order.vue").default);
Vue.component("seller-solditem", require("./components/seller/solditem.vue").default);
Vue.component("chat-show", require("./components/chat/show.vue").default);
Vue.component("chat-index", require("./components/chat/index.vue").default);
Vue.component("address-index", require("./components/address/index.vue").default);
Vue.component("address-create", require("./components/address/create.vue").default);
Vue.component('table-component', TableComponent);
Vue.component('table-column', TableColumn);


 
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data() {
        return {
            loadingClass: "",
        };
    },
    methods: {
        hideLoading() {
            
        }
    },
    mounted() {
        this.loadingClass = "d-none";
        console.log('here')
        console.log('mounted root');
    }
});