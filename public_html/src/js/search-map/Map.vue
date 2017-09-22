<template>
    <div id = "js-map">

    </div>
</template>

<script>

    import {API_HOST} from '../config.js';
    import {PM_BALOON_LT,CR_BALOON_LT, PM_ICON_LT, CR_ICON_LT} from './layouts.js';
    import {bus, formatPrice} from './index.js';
    import basesAPI from './basesAPI.js';
    import queryString from 'query-string'
    export default {
        name: 'root',
        props:['typeEstate'],
        created: function () {

            this.getData(null, ymaps.ready(this.initMap));
            bus.$on('CHANGE_FILTER', function(query) {
                this.getData(query, this.updatePlacemarks);
            }.bind(this))
             
        },
        methods: {
            getData:function(query, callback){
                var API_BASE = basesAPI[this.$props.typeEstate];
                var url = `${API_HOST}${API_BASE}` + (query || '');
                console.log(url)
                fetch(url)
                    .then(res => res.json())
                    .then(res => {
                        this.objects = res;
                        if (callback) {
                            callback();
                        }                        
                    })               
                    .catch(err => new Error(err.message))
            },            
            initMap: function () {
                this.map = new ymaps.Map('js-map', {
                        center: [55.7, 37.6],
                        zoom:14,
                        controls: []
                    },
                    {
                        minZoom:10,
                        maxZoom:17,
                    });
                this.map.controls.add(new ymaps.control.ZoomControl({options: { position: { right: 10, top: 50 }}}));
                this.map.behaviors.disable('scrollZoom');
                this.map.events.add('balloonopen', (e) => {
                    var balloon = e.get('balloon');
                    this.map.events.add('click', (e) => {
                        if (e.get('target') === this.map) { // Если клик был на карте, а не на геообъекте
                            this.map.balloon.close();
                        }
                    });
                });
                this.updatePlacemarks();
            }, 
            updatePlacemarks: function () {
                this.map.geoObjects.removeAll();    
                var geoCluster = new ymaps.Clusterer({
                    groupByCoordinates:true,
                    clusterIconLayout: ymaps.templateLayoutFactory.createClass(CR_ICON_LT),

                    clusterIconShape: {
                        type:"Rectangle",
                        coordinates:[
                            [-20, 0], [80, -38]
                        ]
                    },
                    clusterBalloonCloseButton: false,
                    clusterBalloonItemContentLayout: ymaps.templateLayoutFactory.createClass(CR_BALOON_LT),
                    clusterBalloonLeftColumnWidth: 100,
                    clusterBalloonContentLayoutHeight: 347,
                    clusterBalloonContentLayoutWidth: 350,
                    clusterDisableClickZoom: true,
                });
                this.objects.forEach((el,index,arr) => {
                    geoCluster.add(new ymaps.Placemark(
                        [el.longitude, el.latitude],
                        {
                            clusterCaption: formatPrice(el.cost),                            
                            cost: el.cost,
                            adres: el.adres,
                            type: el.type,
                            floor: el.floor,
                            size: el.size,
                            rooms: el.rooms,
                            rayon: el.rayon + " район",
                            url: el.url,
                            image: el.image,
                            squareGa:el.squareGa,
                            generalSquare:el.generalSquare,
                            usefullSquare:el.usefullSquare,
                            square:el.square                            

                        },
                        {
                            iconLayout:ymaps.templateLayoutFactory.createClass(PM_ICON_LT),
                            iconShape: {
                                type:"Rectangle",
                                coordinates:[
                                    [-20, 0], [80, -38]
                                ]
                            },
                            balloonContentLayout: ymaps.templateLayoutFactory.createClass(PM_BALOON_LT),
                            balloonCloseButton: true,
                            balloonMinWidth: 250,
                            openEmptyBalloon:true
                        }
                    ))
                });

                this.map.geoObjects.add(geoCluster);

                this.updateClusterMinCost(geoCluster);

                this.map.setBounds(this.map.geoObjects.getBounds(), {
                    checkZoomRange:true,
                });

                this.map.events.add('boundschange', () => {
                    this.updateClusterMinCost(geoCluster);
                })



            },
            updateClusterMinCost:function(geoCluster){
                var clusters = geoCluster.getClusters();
                clusters.forEach((cluster) => {
                    var geoObjects = cluster.properties.get('geoObjects');
                    var costs = [];
                    geoObjects.forEach((obj) => costs.push(obj.properties.get('cost')));
                    var minCost = Math.min.apply(null, costs);
                    var formatMinCost = formatPrice(minCost);
                    cluster.properties.singleSet('minCost', formatMinCost);
                })
            },
            data: function () {
                return {
                    map: null,
                    objects: null
                }
            }
        }
    }
</script>
<style>
    #js-map {
        min-height:800px;
    }
</style>