import Vue from 'vue';
import Root from './Root.vue'

if (document.getElementById('vue-svg-maker')) {
    new Vue({
        el: '#vue-svg-maker',

        render: function (createElement) {
            return createElement(Root)
        }
    })
}