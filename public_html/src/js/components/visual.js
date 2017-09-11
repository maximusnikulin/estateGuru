function Visual(elem) {
    this.root = elem;        
    this.init = function(){        
        this.hoverable();
        this.cardPosition()
    }
    this.cardPosition = function() {        
        var $paths = this.root.find('.polygon path');  
        
        for (var i = 0; i < $paths.length; i++) {
            var curPath = $($paths[i]);            
            var a = curPath.parent();
            $(a).on('click', function(e) {
                if (window.innerWidth < 1024 ) {
                    e.preventDefault();                
                };
            })
           
            var yCard = curPath.offset().top - this.root.offset().top, 
                xCard = curPath.offset().left - this.root.offset().left - 20,
                wCard = curPath.get(0).getBoundingClientRect().width, 
                hCard = curPath.get(0).getBoundingClientRect().height,            
                card = curPath.next().find('.polygon__card-mb'),          
                toggler = curPath.next().find('.polygon__toggler-mb');
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
                })
        }
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
            // $tooltips.addClass("hidden").removeClass("show")
            $tooltipCur.addClass("show").removeClass("hidden")      
        });
    }
}

let visual = new Visual($('.js-visual'))
visual.init();