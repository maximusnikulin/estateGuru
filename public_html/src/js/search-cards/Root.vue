<template>
    <section class = "section-search section-search--cards" >
        <h1 class="section-search__title">
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
