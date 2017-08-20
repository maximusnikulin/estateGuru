import lightGallery from 'lightgallery';
import "lg-thumbnail"
const SETTINGS = {
    selector: ".photo",
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: true,
    subHtmlSelectorRelative: true
}
$(window).on('load', function(){
    $(".js-gallery-polygon").lightGallery(SETTINGS)
})