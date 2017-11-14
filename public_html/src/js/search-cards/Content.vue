<template>
    <ul class="section-cards__content"  v-if = "loading">        
        <li class = "prelaoder">
            <div class = "preloader__content"></div>
        </li>
    </ul>
    <ul class="section-cards__content"  v-else-if = "objects.length == 0">        
        <div class = "not-found-cards">
            Ваш поиск не дал результатов
        </div>
    </ul>
    <ul class="section-cards__content"  v-else >        
        <li class="section-cards__content-item" v-for="item in objects">
            <a class="card-estate" v-bind:href= "item.url">
                <div class="card-estate__head">
                    <div class="photo" v-bind:style="{
                        backgroundImage: 'url(' + item.image +')'
                    }"></div>
                    <div class="price">
                        <span class="price__title">Цена</span>
                        <span class="price__val">{{item.cost | formatCost }} &nbsp;₽</span>
                    </div>
                    
                   <ul class="tags" v-show = "item.isPromo">
                            <li class="tags__item tags__item--sale">Скидка</li>
                    </ul>
                </div>
                <div class="card-estate__name">
                    <h2 class="address" v-html = "item.adres"></h2>

                </div>
                <div class="card-estate__more">                 
                    <div class="row">
                        <div class="row__name">Район</div>
                        <div class="row__val">{{item.rayon}}</div>
                    </div>
                    <div class="row" v-show = "item.walls">
                        <div class="row__name">Тип стен</div>
                        <div class="row__val">{{item.walls}}</div>
                    </div>
                    <div class="row" v-show = "item.builder">
                        <div class="row__name">Застройщик</div>
                        <div class="row__val">{item.builder}</div>
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
                    <div class="cell" v-show = "item.squareGa">
                        <p class="cell__title">Площадь</p>
                        <p class="cell__val">{{item.squareGa}} Сот</p>
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
            console.log();
            bus.$on('CHANGE_FILTER', function (query) {
                this.getData(query)
            }.bind(this))

        },
        data: function () {
            return {
                objects: [],
                last_page:false,
                loading:true
            }
        },
        methods: {
            getData: function (query, callback) {

                var API_BASE = basesAPI[this.$props.typeEstate],
                               url = `${API_HOST}${API_BASE}` + (query || '');                

                this.loading = true;
                fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        this.loading = false;
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