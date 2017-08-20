function Visual(elem) {
    this.root = elem;        
    this.init = function(){        
        this.hoverable();
    }
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
            $tooltips.addClass("hidden").removeClass("show")
            $tooltipCur.addClass("show").removeClass("hidden")      
        });
    }
}

let visual = new Visual($('.js-visual'))
visual.init();