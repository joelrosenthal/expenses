
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

var moment = require('moment');
Vue.prototype.moment = moment;

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI, { locale });

import Vuetable from 'vuetable-2';
Vue.use(Vuetable);

Vue.component("vuetable", Vuetable);
/*Vue.component("vuetable-pagination", VueTablePagination);
Vue.component("vuetable-pagination-dropdown", VueTablePaginationDropDown);
Vue.component("vuetable-pagination-info", VueTablePaginationInfo);*/

var moment = require('moment');
Vue.prototype.moment = moment;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('expenditure-form', require('./components/ExpenditureForm'));
Vue.component('expenditure-table', require('./components/ExpenditureTable'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);

const app = new Vue({
    el: '#app'
});
