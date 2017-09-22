 $(window).on('load', function(){
     if(typeof ymaps !== 'undefined' && document.getElementById('map-contacts')) {
        ymaps.ready(init);
     }
    
 }) 
 var myMap;

 function init() {
     const GEO_MARKER = [53.34970357110838,83.7723649999999];
     myMap = new ymaps.Map("map-contacts", {
         center: GEO_MARKER,
         zoom: 16,
         controls: []
     });
    myMap.behaviors.disable('scrollZoom');
    myMap.behaviors.disable('dblClickZoom');
    var placemark = new ymaps.Placemark(GEO_MARKER, {
                name: ' Офис',                
            }, {
                iconLayout: 'default#image',
                iconImageHref: '/svg-icons/marker_eg.svg',
                iconImageSize: [50, 62],
            });
    myMap.geoObjects.add(placemark)
 }