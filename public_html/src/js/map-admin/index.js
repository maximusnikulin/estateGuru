
$(function(){
    var latInput = document.querySelector(".js-map-lat");                       
    var longInput = document.querySelector(".js-map-long");                       

    function changeLatLong (coords) {    
        console.log(coords)    
        var lat = coords[0];
        var long = coords[1];

        latInput.value = lat;
        longInput.value = long;
    }

    ymaps.ready(function() { 
        var map = new ymaps.Map("js-map-admin", {
            center: [53.34013705434741,83.71421803710936],
            zoom:10,
            controls: ['searchControl', "zoomControl"]
        }); 
        var resGeoObject;
        
        var searchControl = map.controls.get('searchControl');
        console.log(searchControl)
        searchControl.events.add("resultselect", function (e) {
                        
            resGeoObject = searchControl.getResultsArray()[0];            
            changeLatLong(resGeoObject.geometry.getCoordinates());
        });
    });
    
})

