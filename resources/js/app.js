
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.axios= require('axios');

Vue.prototype.trans = (key) => {
    return _.get(window.trans, key, key);
};
import Swal from 'sweetalert2'
import VueProgressBar from 'vue-progressbar'
import moment from 'moment'
import { Form, HasError, AlertError } from 'vform'
const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    height:'5px'
}
Vue.use(VueProgressBar, options)
window.Swal = Swal;
window.moment = moment;
window.Form = Form;
Vue.component('date-picker', {
    template: '<input class="form-control date" id="datepicker"/>',
});
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

Vue.filter('dateformat',function(value){
    return moment(value).format('YYYY-MM-DD');
})

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;

let Fire = new Vue();
window.Fire = Fire;



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('pagination', require('laravel-vue-pagination'));
// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
Vue.component('limitations-component', require('./components/LimitationsComponent.vue').default);
Vue.component('limitations-daily-component', require('./components/LimitationsDailyComponent.vue').default);
Vue.component('limitations-cred-component', require('./components/LimitationsCredComponent.vue').default);
Vue.component('limitations-debt-component', require('./components/LimitationsDebtComponent.vue').default);
Vue.component('limitations-editcomponent', require('./components/LimitationEditComponent.vue').default);
Vue.component('opening-editcomponent', require('./components/OpeningEditComponent.vue').default);
Vue.component('receipts-editcomponent', require('./components/ReceiptsEditComponent.vue').default);
Vue.component('openingentry-component', require('./components/OpeningentryComponent.vue').default);
Vue.component('receipts-component', require('./components/ReceiptsComponent.vue').default);
Vue.component('receipts-caching-component', require('./components/ReceiptsCachingComponent.vue').default);
Vue.component('receipts-catch-component', require('./components/RecieiptsCatchComponent.vue').default);
Vue.component('progress-component', require('./components/ProgressComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('chosen-component', require('./components/ChosenComponent.vue').default);
Vue.component('carousel-component', require('./components/CompanyCarouselComponent.vue').default);
Vue.component('movement-of-papers', require('./components/BusinessOwnersInterviews/Movementofpapers.vue').default);
Vue.component('movement-of-medical', require('./components/BusinessOwnersInterviews/Movementofmedical.vue').default);
Vue.component('movement-of-visa', require('./components/BusinessOwnersInterviews/Movementofvisa.vue').default);
Vue.component('movement-of-contract', require('./components/BusinessOwnersInterviews/Movementofcontract.vue').default);
Vue.component('movement-of-passport', require('./components/BusinessOwnersInterviews/Movementofpassport.vue').default);
Vue.component('movement-of-travel', require('./components/BusinessOwnersInterviews/Movementoftravel.vue').default);
Vue.component('move-contract-fees', require('./components/ShowMoveContractReports/ShowMoveContract.vue').default);
Vue.component('movement-of-reports', require('./components/BusinessOwnersInterviews/Movementofreports.vue').default);
Vue.component('cultural-mission', require('./components/BusinessOwnersInterviews/CulturalMission.vue').default);
Vue.component('contractor-reports-movement', require('./components/BusinessOwnersInterviews/ContractorReportsMovement.vue').default);
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
