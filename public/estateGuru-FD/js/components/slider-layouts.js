const SETTINGS = {
    nextArrow: `<button class = "arrow arrow--next"></button>`,
    prevArrow: `<button class = "arrow arrow--prev"></button>`,
    slidesToShow:1,
    infinite:false,
    swipe:true,
    draggable:true
}

$(window).on('load', function () {
    var $slider = $('.js-slider-layouts');
    $slider.slick(SETTINGS)
});