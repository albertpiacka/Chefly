//Router
import Router from 'vue-router'


// Views
import Dashboard from './views/Dashboard.vue'
import Comments from './views/Comments.vue'
import Posts from './views/Posts.vue'
import Users from './views/Users.vue'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [
        { 
            path: '/admin/', 
            component: Dashboard 
        },

        { 
            path: '/admin/posts', 
            component: Posts 
        },

        { 
            path: '/admin/comments', 
            component: Comments
        },

        { 
            path: '/admin/users', 
            component: Users 
        }
    ]
});
