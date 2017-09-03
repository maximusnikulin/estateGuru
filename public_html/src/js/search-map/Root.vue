<template>
    <div class = "section-search-map__content">
        <vue-filter></vue-filter>
        <vue-map></vue-map>
    </div>

</template>

<script>
    import {API_HOST} from '../config.js';
    import {PM_BALOON_LT, CR_BALOON_LT, PM_ICON_LT, CR_ICON_LT} from './layouts.js';    
    import Map from './Map.vue';
    import Filter from './Filter.vue';
    import {bus} from './index.js';


    export default {
        name: 'root',
        components: {
            'vue-map': Map,
            'vue-filter': Filter
        },
        
        created:function(){

        },
        data:function(){
            return {                
                objects:[]
            }
        }

    }
</script>
<style>
    #js-map {
        min-height: 800px;
    }
</style> 