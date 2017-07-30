import Vue from 'vue';
import Root from './search/Root.vue'


new Vue({
    el:'#vue-search',
   
    render:function(createElement) {
        return createElement(Root)
    }
})