<template>
    <div class = "root" >        
        <vue-filter :title = "title"></vue-filter>
        <vue-content :title = "title"></vue-content>
    </div>
</template>

<script>    
import vueContent from './Content';
import vueFilter from './Filter';
import {bus} from './index.js';

export default {
    name:'root',
    components: {
        'vue-content':vueContent,
        'vue-filter':vueFilter
	},
    data: function(){
        return {
           title:"Default title from Root",
        }
    }
}
</script>
<style scoped> 
    .root {
        border:2px solid blue;
    }
</style> 