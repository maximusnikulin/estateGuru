$(window).on("load", function(){
    var container = $(".object__desc-on-map");
    
    if (container.length) {
        ymaps.ready(function() {            
            var geo = container.data("geo").split(",");
            var map  = new ymaps.Map(container.get(0), {
                center: geo,
                zoom:12,
                controls: ['zoomControl']
            });
            var marker = new ymaps.Placemark(geo);
            map.geoObjects.add(marker)
        })
    }
});