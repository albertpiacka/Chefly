/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

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

Vue.component('flash-message', require('./components/flashMessage.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
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

//Movement Animation to happen
const card = document.querySelector(".post");
const container = document.querySelector(".animation-container");

const svg = document.querySelector(".post svg");
const h2 = document.querySelector(".post h2");
const h3 = document.querySelector(".post h3");
const p = document.querySelector(".post p");

const cardElements = [svg, h2, h3, p];

if(container){
    //Moving Animation Event
    container.addEventListener("mousemove", (e) => {
        let xAxis = (window.innerWidth / 2 - e.pageX) / 150;
        let yAxis = (window.innerHeight - e.pageY) / 150;
        card.style.transform = `rotateY(${xAxis}deg) rotateX(${yAxis}deg)`;
    });
    //Animate In
    container.addEventListener("mouseenter", (e) => {
        card.style.transition = "none";
    
        cardElements.forEach(el => {
            el.style.transform = "translateZ(50px)";
        });
    });
    //Animate Out
    container.addEventListener("mouseleave", (e) => {
        card.style.transition = "all 0.5s ease";
        card.style.transform = `rotateY(0deg) rotateX(0deg)`;

        cardElements.forEach(el => {
            el.style.transform = "translateZ(0px)";
        });
    });
}