<template>
    <div class = "section-search section-search--map">
        <h1 class="section-search__title">
           {{typeEstate | getCaption}}
        </h1>
        <div class="section-search__content">
            <vue-filter v-bind:typeEstate = "typeEstate"></vue-filter>
            <vue-map v-bind:typeEstate = "typeEstate"></vue-map>
        </div>
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
                typeEstate: window.settingsFilter.typeEstate
            }
        },
         filters: {
        getCaption:function(value) {
            switch (value) {
                case 'cottage':
                    return 'Поиск Коттеджей';
                case 'apartments':
                    return 'Поиск Квартир';
                case 'second':
                    return 'Поиск Вторичной недвижимости';
                case 'earth':
                    return 'Поиск Земельных участков';
                case 'commercial':
                    return 'Поиск Коммерческой недвижимости';
            }
        }
    }

    }
</script>
