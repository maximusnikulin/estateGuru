 $(window).on('load', function(){
     if(typeof ymaps !== 'undefined') {
        ymaps.ready(init);
     }
    
 }) 
 var myMap;

 function init() {
     const GEO_MARKER = [53.351337351558506,83.7698471411085];
     myMap = new ymaps.Map("map-contacts", {
         center: [53.351337351558506,83.7698471411085],
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