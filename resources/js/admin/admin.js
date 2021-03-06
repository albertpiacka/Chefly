import '../bootstrap'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import router from './router'
import Admin from './Admin.vue'
import Chart from 'chart.js'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)

const admin = new Vue({
    router,
    render: h => h(Admin),
}).$mount('#admin');

