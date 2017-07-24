function Visual(elem) {
    this.root = elem;        
    this.init = function(){
        // this.posPolygon();
        this.hoverable();
    }
    this.hoverable = function(){
        var $tooltips = this.root.find('.tooltip');                     
        var $polygons = this.root.find('.polygon polygon');                     
        $polygons.mouseleave(function(){
            $tooltips.addClass("hidden").removeClass("show")
        });
        $polygons.mousemove(function(e){
           let $target = $(e.target); 
           let idPolygon = $(this).data("id");                   
           let $tooltipCur = $tooltips.filter('.tooltip[data-id=' + idPolygon + ']');                           
           console.log(idPolygon,$tooltipCur);
           let parentOffset = $(this).parents('.polygon').offset(); 
           $tooltipCur.css({
                left: e.pageX - parentOffset.left,
                top: e.pageY - parentOffset.top,                   
            })               
            $tooltips.addClass("hidden").removeClass("show")
            $tooltipCur.addClass("show").removeClass("hidden")      
        })
    }
    this.posPolygon = function(){
        let root = this.root;
        let polygons = root.find('.polygon');                
        polygons.each(function(index, elem){
            let $elem = $(elem)
            let pos = $(elem).data('pos').split(',');            
            let id = $(elem).data('id');            
           
            $elem.css({
                left:pos[1] + '%',
                top:pos[0] + '%',
                visibility:'visible'
            })
            
        })
    }
}

let visual = new Visual($('.js-visual'))
visual.init();