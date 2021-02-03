require('../bootstrap');

Vue.component('flash-message', require('./components/FlashMessage.vue').default);

Vue.component('quick-post', require('./components/QuickPost.vue').default);
Vue.component('quick-post-form', require('./components/QuickPostForm.vue').default);

Vue.component('searching', require('./components/Searching.vue').default);
Vue.component('searched-data', require('./components/SearchedData.vue').default);

Vue.component('the-chat', require('./components/TheChat.vue').default);
Vue.component('open-chat', require('./components/OpenChat.vue').default);

Vue.component('update-comment', require('./components/Comment.vue').default);
Vue.component('create-comment', require('./components/CreateComment.vue').default);
Vue.component('comments-all', require('./components/CommentsAll.vue').default);
Vue.component('like-post', require('./components/LikePost.vue').default);
Vue.component('bookmark-post', require('./components/BookmarkPost.vue').default);

Vue.component('user-panel', require('./components/UserPanel.vue').default);
Vue.component('profile-content', require('./components/ProfileContent.vue').default);
Vue.component('user-content', require('./components/UserContent.vue').default);
Vue.component('user-avatar', require('./components/UserAvatar.vue').default);
Vue.component('follow-user', require('./components/FollowUser.vue').default);
Vue.component('following-posts', require('./components/FollowingPosts.vue').default);
Vue.component('users-all', require('./components/UsersAll.vue').default);
Vue.component('search-bar', require('./components/SearchBar.vue').default);
Vue.component('edit-user', require('./components/EditUser.vue').default);

const app = new Vue({
    el: '#app'
});


/**
 * Inspired by DesignCourse >> https://www.youtube.com/watch?v=ZKXv_ZHQ654&t=927s&ab_channel=DesignCourse
 * Dark / Light toggle mode
 */

var changeTheme = function () {
    var checkbox = document.querySelector('input[name=theme]'),
        theme = localStorage.getItem('theme');

    return {
        run: function () {
            document.documentElement.setAttribute('data-theme', theme);

            if (checkbox) {
                if (theme == 'dark') {
                    checkbox.checked = true;
                }

                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        trans();
                        localStorage.setItem('theme', 'dark');
                        document.documentElement.setAttribute('data-theme', 'dark');
                    } else {
                        trans();
                        localStorage.setItem('theme', 'light');
                        document.documentElement.setAttribute('data-theme', 'light');
                    }
                });

                let trans = () => {
                    document.documentElement.classList.add('transition');
                    window.setTimeout(() => {
                        document.documentElement.classList.remove('transition');
                    }, 1000);
                };
            }
        }
    };
}();

changeTheme.run();

/**
 * Inspired by Dev Ed >> https://www.youtube.com/watch?v=XK7T3mY1V-w&ab_channel=DevEd
 * Neat 3D animation when you hover over article
 */

const card = document.querySelector(".post");
const container = document.querySelector(".animation-container");

//Moving Animation Event
if(container){
    container.addEventListener("mousemove", (e) => {
        let xAxis = (window.innerWidth / 2 - e.pageX) / 400;
        card.style.transform = `rotateY(${xAxis}deg)`;
      });
      //Animate In
      container.addEventListener("mouseenter", (e) => {
        card.style.transition = "none";
      });
      //Animate Out
      container.addEventListener("mouseleave", (e) => {
        card.style.transition = "all 0.5s ease";
        card.style.transform = `rotateY(0deg) rotateX(0deg)`;
      });       
}

