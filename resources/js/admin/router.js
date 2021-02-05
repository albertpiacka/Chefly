//Router
import Router from 'vue-router'


/**
 * Views
 */

//General
import Dashboard from './views/Dashboard.vue'

//Comments
import Comments from './views/comments/Comments.vue'
import singleComment from './views/comments/singleComment.vue'
import editComment from './views/comments/editComment.vue'

//Posts
import Posts from './views/posts/Posts.vue'
import singlePost from './views/posts/singlePost.vue'
import editPost from './views/posts/editPost.vue'
import newPost from './views/posts/newPost.vue'

//Quickposts
import Quickposts from './views/Quickposts/Quickposts.vue'
import singleQuickpost from './views/Quickposts/singleQuickpost.vue'
import editQuickpost from './views/Quickposts/editQuickpost.vue'
import newQuickpost from './views/Quickposts/newQuickpost.vue'

//Users
import Users from './views/users/Users.vue'
import singleUser from './views/users/singleUser.vue'
import editUser from './views/users/editUser.vue'

//404
import page404 from './views/404.vue'

Vue.use(Router);

export default new Router({
    mode: 'history',
    routes: [

        //General
        { 
            path: '/admin/', 
            component: Dashboard 
        },

        //Quickposts
        {
            path: '/admin/quickposts',
            component: Quickposts
        },

        { 
            path: '/admin/quickposts/:id', 
            component: singleQuickpost 
        },

        { 
            path: '/admin/quickposts/:id/edit', 
            component: editQuickpost 
        },

        { 
            path: '/admin/new-quickpost', 
            component: newQuickpost 
        },

        //Posts
        { 
            path: '/admin/posts', 
            component: Posts 
        },

        { 
            path: '/admin/posts/:slug', 
            component: singlePost 
        },

        { 
            path: '/admin/posts/:slug/edit', 
            component: editPost 
        },

        { 
            path: '/admin/new-post', 
            component: newPost 
        },

        //Comments
        { 
            path: '/admin/comments', 
            component: Comments
        },

        { 
            path: '/admin/comments/:id', 
            component: singleComment 
        },

        { 
            path: '/admin/comments/:id/edit', 
            component: editComment 
        },

        //Users
        { 
            path: '/admin/users', 
            component: Users 
        },

        { 
            path: '/admin/users/:id', 
            component: singleUser 
        },

        { 
            path: '/admin/users/:id/edit', 
            component: editUser 
        },

        //404
        { 
            path: '/admin/404', 
            component: page404 
        },

        { 
            path: '*', 
            component: page404 
        },


    ]
});
