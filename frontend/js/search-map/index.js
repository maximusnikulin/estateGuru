import Vue from 'vue';
import Root from './Root.vue'

if (document.getElementById('vue-search-map')) {
    new Vue({
        el: '#vue-search-map',

        render: function (createElement) {
            return createElement(Root)
        }
    })
}