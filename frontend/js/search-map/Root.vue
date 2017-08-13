<template>
    <div id = "js-map">
    </div>
</template>

<script>
    import {API_HOST} from '../config.js';
    import objects from './objects.json';
    console.log(objects);
    export default {
        name: 'root',
        created: function () {
             this.successFetch(objects);
//            fetch(API_HOST + '/api/objects', {credentials:'include'})
//                .then(this.successFetch)
//                .catch()
        },
        methods: {
            successFetch: function (result) {
                this.objects = result;

                ymaps.ready(this.initMap)

            },
            initMap: function () {
                this.map = new ymaps.Map('js-map', {
                    center: [55.7, 37.6],
                    zoom: 10,
                    controls: ['zoomControl']
                });
                this.map.behaviors.disable('scrollZoom');
                this.updatePlacemarks();
            },
            updatePlacemarks: function () {
                var geoCluster = new ymaps.Clusterer();

                this.objects.forEach((el,index,arr) => {
                    geoCluster.add(new ymaps.Placemark(
                        el.geo
                    ))
                });

                this.map.geoObjects.add(geoCluster);
                this.map.setBounds(geoCluster.getBounds())
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