import Vue from 'vue';
import Root from './Root.vue'

//Event Bus
export const bus = new Vue();
console.log('object');
if (document.getElementById('vue-search-cards')) {
    new Vue({
        el: '#vue-search-cards',
        render: function (createElement) {
            return createElement(Root)
        }
    })
}