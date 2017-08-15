<template>
    <div id = "js-map">

    </div>
</template>

<script>
    import {API_HOST} from '../config.js';
    import {PM_BALOON_LT,CR_BALOON_LT, PM_ICON_LT, CR_ICON_LT} from './layouts.js';
    import objects from './objects.json';
    export default {
        name: 'root',
        created: function () {
            this.successFetch(objects);
        },
        methods: {
            successFetch: function (result) {
                this.objects = result;
                ymaps.ready(this.initMap)

            },
            initMap: function () {
                this.map = new ymaps.Map('js-map', {
                        center: [55.7, 37.6],
                        zoom:12,
                        controls: ['zoomControl']
                    },
                    {
                        minZoom:10,
                        maxZoom:14,
                    });

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
            updateClusterMinPrice:function(geoCluster){
                var clusters = geoCluster.getClusters();
                clusters.forEach((cluster) => {
                    var geoObjects = cluster.properties.get('geoObjects');
                    var prices = [];
                    geoObjects.forEach((obj) => prices.push(obj.properties.get('price')));
                    cluster.properties.singleSet('minPrice', Math.min.apply(null, prices));
                })
            },
            updatePlacemarks: function () {
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
                    clusterDisableClickZoom: true
                });
                this.objects.forEach((el,index,arr) => {
                    geoCluster.add(new ymaps.Placemark(
                        el.geo,
                        {
                            clusterCaption: el.price,
                            price:el.price
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
                            balloonMaxWidth: 280,
                            openEmptyBalloon:true
                        }
                    ))
                });

                this.map.geoObjects.add(geoCluster);
                this.map.setBounds(
                    geoCluster.getBounds(),
                    {
//                        checkZoomRange: true
                    }
                );
                this.updateClusterMinPrice(geoCluster);
                this.map.events.add('boundschange', () => {
                    this.updateClusterMinPrice(geoCluster);
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