<template>
        <div class="filter">
            <div class="filter__title">Выберите параметры</div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Цена</h2>
                    <p class="caption">
                        От {{state.price[0]}} до {{state.price[1]}}
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-slider v-model="state.price"
                                :min="settings.price[0]"
                                :max="settings.price[1]"
                                :tooltip="false"
                                :dot-size="30"
                                :process-style="{
                                background:'#62bb46',                                
                            }"></vue-slider>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Площадь</h2>
                    <p class="caption">
                        От {{state.area[0]}} до {{state.area[1]}}
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-slider v-model="state.area"
                                :min="settings.area[0]"
                                :max="settings.area[1]"
                                :tooltip="false"
                                :dot-size="30"
                                :process-style="{
                                    background:'#62bb46',
                                }"></vue-slider>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Количество комнат</h2>
                    <p class="caption">
                        Выберите количество комнат
                    </p>
                </div>
                <div class="filter__group-input">
                    <label class="checkbox">
                        <input type="checkbox" value="1" v-model="state.rooms"/>
                        <div class="box">1</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="2" v-model="state.rooms"/>
                        <div class="box">2</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="3" v-model="state.rooms"/>
                        <div class="box">3</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="4" v-model="state.rooms"/>
                        <div class="box">4+</div>
                    </label>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Район</h2>
                    <p class="caption">
                        Выберите район
                    </p>
                </div>
                <div class="filter__group-input">
                   <vue-select
                        v-model = "state.district "
                        :options = "settings.district"
                        :allow-empty="false"                       
                        :searchable="true"
                        :show-labels="false"
                        placeholder = "Найти"
                        open-direction = "below"
                   ></vue-select>
                </div>
            </div>
            <div class="filter__group">
                <button class = "button button--action button--filter" v-on:click = "makeQuery">Найти</button>
            </div>
        </div>

</template>

<script>
    import {API_HOST} from '../config.js';
    import vueSlider from 'vue-slider-component';
    import Multiselect from 'vue-multiselect'
    import queryString from 'query-string';
    import {bus} from './index.js';

    export default {
        name: 'vue-filter',
        components: {
            'vue-slider': vueSlider,
            'vue-select': Multiselect
        },
        updated: function () {
          
        },
        data: function () {
            return {
                open:false,                
                settings: {
                    price: [0,1000000], 
                    district: [
                        "Любой",
                        "Железнодорожный",
                        "Индустриальный",
                        "Ленинский",
                    ],
                    area:[0, 56]
                },
                state: {
                    price:[0, 10000000],
                    area:[0, 56],
                    district: "Любой",
                    rooms: []
                }, 
            }
        },        
        methods: {
            parseQuery: function(){

            },
            makeQuery:function(){
                var query = queryString.stringify(this.state, { arrayFormat: 'bracket' })
                console.log(query);
                console.log(queryString.parse('area[]=0&area[]=56&district=%D0%9B%D1%8E%D0%B1%D0%BE%D0%B9&price[]=0&price[]=1000000',{ arrayFormat: 'bracket' }))
                bus.$emit("parse")
            }
        }
    }
</script>
<style>

</style>