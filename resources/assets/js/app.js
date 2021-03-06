//require('./bootstrap');

//Libraries
import Vue from 'vue';
import VueMoment from 'vue-moment'
import moment from 'moment'

//Components
import privateLessonRequestForm from './components/PrivateLessonRequestForm'
import swimTeamRoster from './components/SwimTeamRoster'
import promo_code from './components/promoCode'

Vue.use(VueMoment, {
    moment,
});

const app = new Vue({
    el: '#app',
    components: {
        swimTeamRoster,
        privateLessonRequestForm,
        promo_code: promo_code
    }
});
