$(function(){    
    var latInput = document.querySelector(".js-map-lat");                       
    var longInput = document.querySelector(".js-map-long");                           
    var settings =  {
        alreadySet:latInput.value && longInput.value,
        get lat() {
            return this.alreadySet ? latInput.value : 53.34013705434741
        },
        get long() {
            return this.alreadySet ? longInput.value : 83.71421803710936
        },
        get placemark(){
            return [this.lat, this.long]
        }
    }
    function changeLatLong (coords) {    
        
        var lat = coords[0];
        var long = coords[1];

        latInput.value = lat;
        longInput.value = long;
    }

    ymaps.ready(function() { 
        
        var map = new ymaps.Map("js-map-admin", {
            center: settings.placemark,
            zoom:17,
            controls: ['searchControl', "zoomControl"]
        }); 
                
        var handleDragEnd = function(e) {
            changeLatLong(getGeoCoords(e.originalEvent.target))
        }
        var getGeoCoords = function(target) {
            return target.geometry
                    .getCoordinates()
                    .map(el => el.toFixed(8))
        }
        var searchControl = map.controls.get('searchControl'); 
        searchControl.events.add("resultselect", function (e) {                           
            map.geoObjects.removeAll();
            var geoObject = searchControl.getResultsArray()[0];                       
            geoObject.options.set('draggable', true);            
            geoObject.events.add('dragend',handleDragEnd);
            changeLatLong(getGeoCoords(geoObject))
        }); 
                       
        if (settings.alreadySet) {                        
            var myGeocoder = ymaps.geocode(settings.placemark);
            myGeocoder.then(function(res) {
                var pm = new ymaps.Placemark(settings.placemark, {}, {                    
                    draggable:true                    
                });
                pm.events.add('dragend', handleDragEnd);
                map.geoObjects.add(pm);
            })
        }
    });
    
})

