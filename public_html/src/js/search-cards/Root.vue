<template>
    <section class = "section-search section-search--cards" >
        <h1 v-bind:class= "{
            'section-search__title' : true,
            'section-search__subtitle' : typeEstate == 'building'
        }">
            {{typeEstate | getCaption}}
        </h1>
        <div class="section-search__content">
            <vue-filter v-bind:typeEstate = "typeEstate"></vue-filter>
            <vue-content v-bind:typeEstate = "typeEstate"></vue-content>
        </div>

    </section>
</template>

<script>    
import vueContent from './Content';
import vueFilter from './Filter';
import { bus } from './index.js';

export default {
    name:'root',
    components: {
        'vue-filter':vueFilter,
        'vue-content':vueContent,
	},
    data: function(){
        return {
           typeEstate: window.settingsFilter.typeEstate,
           loading:false
        }
    },
    filters: {
        getCaption:function(value) {
            switch (value) {
                case 'cottage':
                    return 'Поиск Частных домов';
                case 'apartments':
                    return 'Поиск Квартир';
                case 'second':
                    return 'Поиск Вторичной недвижимости';
                case 'earth':
                    return 'Поиск Земельных участков';
                case 'commercial':
                    return 'Поиск Коммерческой недвижимости';
                case 'building':
                    return 'Поиск Квартир в доме';
            }
        }
    }
}
</script>
