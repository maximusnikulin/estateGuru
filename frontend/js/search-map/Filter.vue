<template>
        <div class="filter">
            <div class="filter__group">
                <div class="filter__group-label">
                    <h2 class="title">Цена</h2>
                    <p class="caption">
                        От {{price.value[0]}} до {{price.value[1]}}
                    </p>
                </div>
                <div class="filter__group-input">
                    <vue-slider v-model="price.value"
                                :min="price.min"
                                :max="price.max"
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
                    От {{area.value[0]}} до {{area.value[1]}}
                </p>
            </div>
            <div class="filter__group-input">
                <vue-slider v-model="area.value"
                            :min="area.min"
                            :max="area.max"
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
                        <input type="checkbox" value="1" v-model="rooms"/>
                        <div class="box">1</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="2" v-model="rooms"/>
                        <div class="box">2</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="3" v-model="rooms"/>
                        <div class="box">3</div>
                    </label>
                    <label class="checkbox">
                        <input type="checkbox" value="4" v-model="rooms"/>
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
                        v-model = "district.selected"
                        :options = "district.list"
                        :allow-empty="false"
                        track-by="name"
                        label = "label"
                        :searchable="true"
                        :show-labels="false"
                        placeholder = "Найти"
                   ></vue-select>
                </div>
            </div>
        </div>

</template>

<script>
    import {API_HOST} from '../config.js';
    import vueSlider from 'vue-slider-component';
    import Multiselect from 'vue-multiselect'

    export default {
        name: 'vue-filter',
        components: {
            'vue-slider': vueSlider,
            'vue-select': Multiselect
        },
        updated: function () {
            console.log(this.district.value)
        },
        data: function () {
            return {
                price: {
                    min: 0,
                    max: 10000000,
                    value: [0, 10000000]
                },
                area: {
                    min: 0,
                    max: 10000000,
                    value: [0, 10000000]
                },
                district: {
                    list: [
                        { name: "any", label: "Любой" },
                        { name: "zheleznodorozn", label: "Железнодорожный" },
                        { name: "industrialny", label: "Индустриальный" },
                        { name: "leninsky", label: "Ленинский" },
                    ],
                    selected: {
                        name: "any",
                        label: "Любой"
                    }
                },
                rooms: []
            }
        }
    }
</script>
<style>

</style>