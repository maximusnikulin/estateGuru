<template>

    <div v-bind:class="{filter:true, 'filter--close': !this.open, 'filter--sticky' : this.sticky}" ref="filter">
        <div class="filter__icon filter__icon--top" v-on:click="toggleFilter"></div>
        <div class="filter__content" ref = "filter__content" >
            <div class="filter__title">Выберите параметры</div>
            <div class="filter__group" v-show = "typeEstate !== 'building'">
                <div class="filter__group-label">
                    <h2 class="title">Район</h2>
                    <p class="caption">
                        Выберите район в котором хотите найти недвижимость
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-select
                            placeholder="Найти"
                            open-direction="below"
                            @input="(value) => onInput(value, 'rayon')"
                            :options="settings.rayon"
                            :allow-empty="false"
                            :searchable="true"
                            :show-labels="false"
                            :track-by="id"
                            :value="selectedValueRayon"
                            :custom-label = "customLabel"                            
                    ></vue-select>
                </div>
            </div>
            <div class="filter__group" v-if = "typeEstate == 'apartments'">
                <div class="filter__group-label">
                    <h2 class="title">Объект</h2>
                    <p class="caption">
                        Выберите новостройку в которой хотите посмотреть квартиры
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-select
                            ref = "select-building"
                            placeholder="Найти"
                            open-direction="below"
                            @input="(value) => onInput(value, 'building')"
                            :options="computedOptions"
                            :allow-empty="false"
                            :searchable="true"
                            :show-labels="false"
                            :track-by="id"
                            :value="selectedValueBuilding"
                            :custom-label = "customLabel"
                            :disabled = "this.disableBuildings"
                    ></vue-select>
                </div>
            </div>

            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Цена ₽</h2>
                    <p class="caption">
                        От {{values.cost[0] | formatCost }}  до {{values.cost[1] | formatCost}}
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-slider ref="slider-cost"
                                v-model="values.cost"
                                :min="settings.cost[0]"
                                :max="settings.cost[1]"
                                :tooltip="false"
                                :dot-size="30"
                                :disabled = "settings.cost[0] == settings.cost[1]"
                                :process-style="{
                                    background:'#f48220',
                                 }"></vue-slider>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">{{typeEstate == "commercial" ? "Полезная площадь" : "Площадь"}}  {{typeEstate == "earth" ? "Га" : "M²"}}</h2>
                    <p class="caption">
                        От {{values.size[0]}} до {{values.size[1]}}
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-slider ref="slider-area"
                                v-model="values.size"
                                :min="settings.size[0]"
                                :max="settings.size[1]"
                                :tooltip="false"
                                :dot-size="30"
                                :disabled = "settings.size[0] == settings.size[1]"
                                :process-style="{
                                background:'#f48220'}">
                    </vue-slider>
                </div>
            </div>
            <div class="filter__group"  v-show = "typeEstate == 'apartments' || typeEstate == 'second'">
                <div class="filter__group-label">
                    <h2 class="title">Количество комнат</h2>
                    <p class="caption">
                        Выберите количество комнат
                    </p>
                </div>
                <div class="filter__group-input">
                    <label class="checkbox">
                        <input type="checkbox" value="1" v-model="values.rooms"/>
                        <div class="box">1</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="2" v-model="values.rooms"/>
                        <div class="box">2</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="3" v-model="values.rooms"/>
                        <div class="box">3</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="4" v-model="values.rooms"/>
                        <div class="box">4+</div>
                    </label>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Сортировать по:</h2>
                </div>
                 <div class="filter__group-input">
                    <div v-bind:class = "{
                            'filter__group-tag':true,
                            'filter__group-tag--active':this.values.sort == 'cost',
                    }" v-on:click = "() => this.changeSort('cost')">
                        Цене
                    </div>
                     <div v-bind:class = "{
                            'filter__group-tag':true,
                            'filter__group-tag--active':this.values.sort == 'size',
                    }" v-on:click = "() => this.changeSort('size')">
                        Площади
                    </div>
                </div>
            </div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Упорядочить по:</h2>
                </div>
                 <div class="filter__group-input">
                     <div v-bind:class = "{
                            'filter__group-tag':true,
                            'filter__group-tag--active':this.values.sortDir == 'asc',
                    }" v-on:click = "() => this.changeSortDir('asc')">
                        Возрастанию
                    </div>
                     <div v-bind:class = "{
                            'filter__group-tag':true,
                            'filter__group-tag--active':this.values.sortDir == 'desc',
                    }" v-on:click = "() => this.changeSortDir('desc')">
                        Убыванию
                    </div>
                </div>
            </div>
            <div class="filter__group">
                <button class="button button--orange button--filter" v-on:click="makeQuery">Найти</button>
            </div>
        </div>

       
        <div class="filter__icon filter__icon--bottom" v-on:click="toggleFilter"></div>
    </div>

</template>

<script>
    import {API_HOST} from '../config.js';
    import vueSlider from 'vue-slider-component';
    import Multiselect from 'vue-multiselect'
    import queryString from 'query-string';
    import {bus} from './index.js';
    import basesAPI from './basesAPI.js';

    export default {
        name: 'vue-filter',
        props: ["typeEstate"],
        components: {
            'vue-slider': vueSlider,
            'vue-select': Multiselect
        },
        updated: function (e) {            
            var content = document.querySelector('.section-search__content');
            content.style.minHeight = getComputedStyle(this.$refs['filter__content']).height;
        },
        mounted: function() {            
            //Get data
            this.makeQuery();
            //Click out filter close it
            var filter = this.$refs['filter'];
            filter.addEventListener('click', (e) => e.stopPropagation());

            var cards = document.querySelector('.section-search--cards');
            cards.addEventListener('click', (e) => this.open ? this.toggleFilter() : true)

        },
        data: function () {
            return {
                open: false,
                sticky: false,
                settings: window.settingsFilter,
                disableBuildings:false,
                values: {
                    cost: window.settingsFilter.cost,
                    size: window.settingsFilter.size,
                    rayon: "",
                    rooms: [],
                    sortDir:'asc',
                    sort:'cost',
                    building: this.typeEstate == "building" ? window.settingsFilter.building[0].id : ""
                },
            }
        },
        methods: {            
            changeSortDir: function(sortDir) {
                this.values.sortDir = sortDir;
            },
            changeSort: function(sort) {
                this.values.sort = sort;
            },
            makeQuery: function () {
                var query = queryString.stringify(this.values, {arrayFormat: 'bracket'})

                bus.$emit("CHANGE_FILTER", query);
                this.open = false;
            },
            toggleFilter: function () {
                this.open = !this.open;
                this.fixUpdateMultiselect();

            },
            fixUpdateMultiselect: function () {
                setTimeout(() => {
                    this.$refs['slider-cost'].refresh()
                    this.$refs['slider-area'].refresh()
                }, 500)

            },
            customLabel: function (value) {
                return value.label
            },
            onInput: function (value, type) {                
                if (type == "rayon") {
                    this.values.rayon = value.id;                                                            
                } else if (type == "building") {                    
                    this.values.building = value.id
                }
            },

        },
        computed: {
            selectedValueRayon: function () {
                return this.settings.rayon.find(o => o.id == this.values.rayon)
            },
            selectedValueBuilding: function () {
                if (this.values.rayon == "") {
                    return { id: "", label: "Любой" }
                }
                return this.settings.building.find(o => o.id == this.values.building)
            },
            computedOptions: function() {                     
                
                if (this.values.rayon == "") {
                    return [ { id: "", label: "Любой" }, ...this.settings.building];
                }
                let result = this.settings.building.filter(b => {                   
                    return b.idRayon == this.values.rayon;                    
                });                
                if (result.length == 0) {
                    this.values.building = null;
                    this.disableBuildings = true;
                } else {
                    if (result.length > 1){
                        result.unshift({id:"", label:"Любой"});                  
                    } 
                    this.values.building = result[0].id;
                    this.disableBuildings =false;
                }
                return result                
            }
        },
        filters: {
            formatCost: function (value) {
                if (value != 0) {
                    var strValue = value.toString(10);
                    return strValue.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ')
                }
                return "0"
            }
        }
    }
</script>
<style>

</style>