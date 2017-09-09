<template>
    <ul class="section-cards__content">
        <li class="section-cards__content-item" v-for="item in objects">
            <a class="card-estate" href="/dom/lazurnaya-10/31">
                <div class="card-estate__head">
                    <div class="photo"
                         style="background-image:url(http://localhost:8888/uploads/thumbs/realty/images//1000x1000_cropped_ab1856b222b5c50ded6a650dd9049a6a.jpg)"></div>
                    <div class="price">
                        <span class="price__title">Цена</span>
                        <span class="price__val">{{item.cost | formatCost }} &nbsp;₽</span>
                    </div>
                    <!-- <ul class="tags">
                            <li class="tags__item tags__item--sale">Скидка -10%</li>
                        </ul>-->
                </div>
                <div class="card-estate__name">
                    <h2 class="address">{{item.adres}}</h2>

                </div>
                <div class="card-estate__more">
                    <div class="row">
                        <div class="row__name">Тип</div>
                        <div class="row__val">{{item.type}}</div>
                    </div>
                    <div class="row">
                        <div class="row__name">Район</div>
                        <div class="row__val">{{item.rayon}}</div>
                    </div>
                    <div class="row" v-show = "item.builder">
                        <div class="row__name">Застройщик</div>
                        <div class="row__val">ПСК</div>
                    </div>
                    <div class="row" v-show = "item.deadline">
                        <div class="row__name">Срок сдачи</div>
                        <div class="row__val">{{item.deadline}}</div>
                    </div>
                </div>
                <div class="card-estate__info">
                    <div class="cell" v-show="item.floor">
                        <p class="cell__title">Этаж</p>
                        <p class="cell__val">{{item.floor}}</p>
                    </div>
                    <div class="cell" v-show = "item.generalSquare">
                        <p class="cell__title">Общая площадь</p>
                        <p class="cell__val">{{item.generalSquare}} м²</p>
                    </div>
                    <div class="cell" v-show = "item.usefullSquare">
                        <p class="cell__title">Полезная площадь</p>
                        <p class="cell__val">{{item.usefullSquare}} м²</p>
                    </div>
                    <div class="cell" v-show = "item.squareGa">
                        <p class="cell__title">Площадь</p>
                        <p class="cell__val">{{item.squareGa}} Га</p>
                    </div>
                    <div class="cell" v-show = "item.size">
                        <p class="cell__title">Площадь</p>
                        <p class="cell__val">{{item.size}} м²</p>
                    </div>
                    <div class="cell" v-show = "item.square">
                        <p class="cell__title">Площадь</p>
                        <p class="cell__val">{{item.square}} м²</p>
                    </div>
                    <div class="cell" v-show="item.rooms">
                        <p class="cell__title">Комнат</p>
                        <p class="cell__val">{{item.rooms}}</p>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</template>

<script>
    import basesAPI from './basesAPI.js';
    import {API_HOST} from '../config.js';
    import {bus, formatPrice} from './index.js';
    export default {

        name: 'vue-content',
        props: ["typeEstate"],
        created: function () {
            this.getData(null);

            bus.$on('CHANGE_FILTER', function (query) {
                this.getData(query)
            }.bind(this))

        },
        data: function () {
            return {
                objects: [],
                last_page:false
            }
        },
        methods: {
            getData: function (query, callback) {
                var API_BASE = basesAPI[this.$props.typeEstate];


                var url = `${API_HOST}${API_BASE}` + (query || '');
                console.log(url);
                fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        console.log(res)
                        this.objects = res;
                        if (callback) {
                            callback();
                        }
                    })
                    .catch(err => new Error(err.message))
            },
        },
        filters : {
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