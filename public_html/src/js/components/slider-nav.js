const SETTINGS = {
    nextArrow: `<button class = "arrow arrow--next"></button>`,
    prevArrow: `<button class = "arrow arrow--prev"></button>`,
    slidesToShow:3,
    infinite:false,
    swipe:true,
    draggable:false,
        responsive: [ 
        {
            breakpoint: 560,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]   
}
var toggleSlide = function($all, $current){
     $all.removeClass('active');
     $current.addClass('active');
}
var toggleVisual = function($all, $current){
     $all.removeClass('active');
     $current.addClass('active');
}
$(window).on('load', function () {
    var $slider = $('.js-slider-nav');
    $slider.on('init', function(event, slick, currentSlide, nextSlide){
        var currentSlide = currentSlide || 0;
        var slides = slick.$slides;
        $(slides).on('click', function(){
            var $allSlides = $(slides);
            var $curSlide = $(this);
            toggleSlide($allSlides, $curSlide)

            var curNumVisual = $(this).data('number');            
            var curVisual = $(`.visual[data-number=${curNumVisual}]`);            
            var allVisual = $(`.visual`);      
            toggleVisual(allVisual, curVisual)      
            
        });
    })
    $slider.slick(SETTINGS)
});