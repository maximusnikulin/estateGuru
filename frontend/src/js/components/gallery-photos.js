import lightGallery from 'lightgallery';

const settings = {
    selector:".photo",
    thumbnail:true,
    animateThumb: false,
    showThumbByDefault: false   
}
$(window).on('load', function(){
    $(".js-gallery-photos").lightGallery(settings)
})