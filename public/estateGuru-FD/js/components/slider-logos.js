import slick from 'slick-carousel';
const SETTINGS = {
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    nextArrow: `<button class = "arrow arrow--next"></button>`,
    prevArrow: `<button class = "arrow arrow--prev"></button>`,
    swipe: true,
    draggable: false,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
            }
        },        
        {
            breakpoint: 560,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
}

$(window).on('load', function () {
    var $slider = $('.js-slider-logos');
    $slider.slick(SETTINGS)
});