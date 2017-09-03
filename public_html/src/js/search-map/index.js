import Vue from 'vue';
import Root from './Root.vue'

export const bus = new Vue();
export const formatPrice = (price) => String(price).replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')

if (document.getElementById('vue-search-map')) {
    new Vue({

        el: '#vue-search-map',
        
        render: function (createElement) {
            return createElement(Root);
        }
    })
}