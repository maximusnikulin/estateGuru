import lightGallery from 'lightgallery';

import "lg-thumbnail"

// console.log(lightGallery)

const SETTINGS = {
    selector:".slider-layouts__item",
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: true,
    subHtmlSelectorRelative: true
}
$(window).on('load', function(){
    $(".js-gallery-layouts").lightGallery(SETTINGS)
})