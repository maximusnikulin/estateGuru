import slick from 'slick-carousel';
const SETTINGS = {
    nextArrow:`<button class = "arrow arrow--next"></button>`,
    prevArrow:`<button class = "arrow arrow--prev"></button>`,
    swipe:true,
    draggable:false ,
    accessibility: false
} 
$(window).on('load', function(){
    var $slider = $('.js-slider-promo');
    $slider.slick(SETTINGS)
});
