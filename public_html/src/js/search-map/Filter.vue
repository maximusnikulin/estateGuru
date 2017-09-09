<template>

    <div v-bind:class="{filter:true, 'filter--close': !this.open, 'filter--sticky' : this.sticky}" ref="filter">
        <div class="filter__icon filter__icon--top" v-on:click="toggleFilter"></div>

        <div class="filter__content">
            <div class="filter__title">Выберите параметры</div>
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Район</h2>
                    <p class="caption">
                        Выберите район
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-select
                            placeholder="Найти"
                            open-direction="below"
                            @input="onInput"
                            :options="settings.rayon"
                            :allow-empty="false"
                            :searchable="true"
                            :show-labels="false"
                            :track-by="id"
                            :value="selectedValue"
                            :custom-label="customLabel"
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
                                :process-style="{
        background:'#f48220',
        }"></vue-slider>
                </div>
            </div>
            <div class="filter__group"  v-show = "type == 'apartments' || type == 'second'">
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

        },
        created: function () {
            window.addEventListener('scroll', function () {

                var content = document.querySelector('.section-search__content');
                var pos = content.getBoundingClientRect();
                var top = pos.top;
                var bottom = pos.bottom;
                this.sticky = (top <= 0 && bottom >= window.innerHeight);

                // if (bottom <= window.innerHeight) {
                //     this.open = false;
                // }

            }.bind(this));
        },
        data: function () {
            return {
                open: false,
                sticky: false,
                settings: window.settingsFilter,
                values: {
                    cost: window.settingsFilter.cost,
                    size: window.settingsFilter.size,
                    rayon: "",
                    rooms: []
                },
            }
        },
        methods: {
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
            onInput: function (value) {
                this.values.rayon = value.id
            },

        },
        computed: {
            selectedValue: function () {
                return this.settings.rayon.find(o => o.id == this.values.rayon)
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