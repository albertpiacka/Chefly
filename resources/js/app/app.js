
require('../bootstrap');
import anime from 'animejs/lib/anime.es.js'

Vue.component('flash-message', require('./components/FlashMessage.vue').default);
Vue.component('update-comment', require('./components/Comment.vue').default);
Vue.component('create-comment', require('./components/CreateComment.vue').default);
Vue.component('comments-all', require('./components/CommentsAll.vue').default);

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

// Movement Animation to happen
const containers = document.querySelectorAll(".animation-container");

if(containers){
    containers.forEach(container => {
        //Moving Animation Event
        container.addEventListener("mousemove", (e) => {
            let xAxis = (window.innerWidth / 2 - e.pageX) / 5000;
            let yAxis = (window.innerHeight - e.pageY) / 2500;
            container.children[0].style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
        });
        //Animate In
        container.addEventListener("mouseenter", (e) => {
            container.children[0].style.transition = "none";
            
            let containerChildren = container.children[0].children;
            let postBodyChildren = Array.from(containerChildren[0].children);
            let postFooterChildren = Array.from(containerChildren[1].children);

            postBodyChildren.forEach(child => {
                child.style.transform = "translateZ(3px)"
            });
            
            postFooterChildren.forEach(child => {
                child.style.transform = "translateZ(3px)"
            });
        });
        //Animate Out
        container.addEventListener("mouseleave", (e) => {
            container.children[0].style.transition = "all 0.5s ease";
            container.children[0].style.transform = `rotateY(0deg) rotateX(0deg)`;

            let containerChildren = container.children[0].children;
            let postBodyChildren = Array.from(containerChildren[0].children);
            let postFooterChildren = Array.from(containerChildren[1].children);

            postBodyChildren.forEach(child => {
                child.style.transform = "translateZ(0px)"
            });
            
            postFooterChildren.forEach(child => {
                child.style.transform = "translateZ(0px)"
            });
        });
    });
}