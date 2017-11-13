
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
        console.log(settings.placemark)
        var map = new ymaps.Map("js-map-admin", {
            center: settings.placemark,
            zoom:17,
            controls: ['searchControl', "zoomControl"]
        }); 
        
        var resGeoObject;
        
        var searchControl = map.controls.get('searchControl'); 
        searchControl.events.add("resultselect", function (e) {                        
            map.geoObjects.removeAll();
            resGeoObject = searchControl.getResultsArray()[0];                       
            changeLatLong(resGeoObject.geometry.getCoordinates());
        });        
        if (settings.alreadySet) {                        
            var myGeocoder = ymaps.geocode(settings.placemark);
            myGeocoder.then(function(res) {
                var geoObject = res.geoObjects.get(0);
                var request = geoObject.getAddressLine()                
                searchControl.search(request);
                
                map.geoObjects.add(new ymaps.Placemark(settings.placemark));
            })
        }
    });
    
})

