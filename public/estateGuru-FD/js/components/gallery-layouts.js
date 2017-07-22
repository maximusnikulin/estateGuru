import lightGallery from 'lightgallery';

const settings = {
    selector:".slider-layouts__item",
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: true   
}
$(window).on('load', function(){
    $(".js-gallery-layouts").lightGallery(settings)
})