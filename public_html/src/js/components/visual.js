function Visual(elem) {
    this.root = elem;        
    this.init = function(){        
        this.hoverable();
        this.cardPosition();
    };
    this.cardPosition = function() {
        var $cards = this.root.find('.polygon .polygon__mobile-card');
        var $polygons = this.root.find('.polygon path');
        for (var i = 0; i < $polygons.length; i++) {
            var polygon = $($polygons[i]);
            if (polygon.offset().top == 0) {
                var yCard = polygon.get(0).getBoundingClientRect().top - this.root.offset().top ;
                var xCard = polygon.get(0).getBoundingClientRect().left - this.root.offset().left - 20;
            } else {
                var yCard = polygon.offset().top - this.root.offset().top ;
                var xCard = polygon.offset().left - this.root.offset().left - 20;
            }

            var wCard = polygon.get(0).getBoundingClientRect().width ;
            var hCard = polygon.get(0).getBoundingClientRect().height;
            var card = polygon.parents('svg').prev();
            var toggler = polygon.parents('svg').prev().prev();


            card.css({
                left:xCard + "px",
                top:yCard + "px",
                width:wCard + "px",
                height:hCard + "px",
            })
            toggler.css({
                left:xCard + "px",
                top:yCard + "px",
                width:wCard + "px",
            })

            toggler.on("click", function(){
                $(this).toggleClass("polygon__toggler-mb--active");
                $(this).next().toggleClass("polygon__card-mb--active")
            });
        }
    };
    this.hoverable = function(){
        var $tooltips = this.root.find('.tooltip');                     
        var $polygons = this.root.find('.polygon path');                             
        $polygons.mouseleave(function(){
            $tooltips.addClass("hidden").removeClass("show")
        });
        $polygons.mousemove(function(e){
           let $target = $(e.target); 
           let idPolygon = $(this).data("id");                   
           let $tooltipCur = $tooltips.filter('.tooltip[data-id=' + idPolygon + ']');                                                 
           let parentOffset = $(this).parents('.polygon').offset();

           $tooltipCur.css({               
                left: e.pageX - parentOffset.left,
                top: e.pageY - parentOffset.top,                   
            })               
            // $tooltips.addClass("hidden").removeClass("show")
            $tooltipCur.addClass("show").removeClass("hidden")      
        });
    }
}



$(window).on('load', function(){
    var visual = new Visual($('.js-visual'))
    visual.init()
})