<template>
    <div>
    <div class="filter">
        <div class="filter__group">
            <vue-slider v-model = "price.value" v-bind:min = "price.min" v-bind:max = "price.max"></vue-slider>
        </div>
        <div class="filter__group">
            <vue-slider v-model = "area.value" v-bind:min = "area.min" v-bind:max = "area.max"></vue-slider>
        </div>
        <div class="filter__group">
            <label class = "checkbox">
                <input type="checkbox" value = "1" v-model = "rooms"/>
                <div class="box">1</div>
            </label>
            <label class = "checkbox">
                <input type="checkbox" value = "2" v-model = "rooms"/>
                <div class="box">2</div>
            </label>
            <label class = "checkbox">
                <input type="checkbox" value = "3" v-model = "rooms"/>
                <div class="box">3</div>
            </label>
            <label class = "checkbox">
                <input type="checkbox" value = "4" v-model = "rooms"/>
                <div class="box">4</div>
            </label>

        </div>
        <div class="filter__group">
            <vue-select
                    ref = "select"
                    v-model:value.sync = "district.selected"
                    :options = "district.list"
                    :searchable = "false"
                    :onChange = "onChangeSelect"
            ></vue-select>
        </div>
    </div>
    <div>
        <pre>Price</pre>
        <pre>{{price}}</pre>
        <pre>District</pre>
        <pre>{{district}}</pre>
        <pre>Area</pre>
        <pre>{{area}}</pre>
        <pre>Rooms</pre>
        <pre>{{rooms}}</pre>
    </div>
    </div>
</template>

<script>
    import {API_HOST} from '../config.js';
    import vueSlider from 'vue-slider-component';
    import vSelect from "./vue-select.js"
    export default {
        name: 'vue-filter',
        components: {
            'vue-slider' : vueSlider,
            'vue-select' : vSelect
        },
        updated: function(){
            console.log(this.price)
        },
        data: function () {
            return {
                    price: {
                        min:0,
                        max:10000000,
                        value: [0,10000000]
                    },
                    area: {
                        min: 0,
                        max: 10000000,
                        value: [0, 10000000]
                    },
                    district:{
                        list:[
                            {value:"any",label:"Любой"},
                            {value: "zheleznodorozn", label:"Железнодорожный"},
                            {value: "industrialny", label:"Индустриальный"},
                            {value: "leninsky", label:"Ленинский"},
                        ],
                        selected: {
                            value:"any",
                            label:"Любой"
                        }
                    },
                    rooms:[]
            }
        }
    }
</script>
<style>

</style>