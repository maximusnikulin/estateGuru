import Vue from 'vue';
import Root from './Root.vue'

if (document.getElementById('vue-search')) {
    new Vue({
        el: '#vue-search',

        render: function (createElement) {
            return createElement(Root)
        }
    })
}