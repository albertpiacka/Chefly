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

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

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
