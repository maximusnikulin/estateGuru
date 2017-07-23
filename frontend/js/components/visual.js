function Visual(elem) {
    this.root = elem;        
    this.init = function(){
        // this.posPolygon();
        // this.hoverable();
    }
    this.hoverable = function(){
        var $tooltips = this.root.find('.tooltip');                     
        var $svg = this.root.find('.svg');                     
        this.root.mousemove(function(e){
           let $target = $(e.target); 
           let $parrentPolygon = $target.parents('.polygon')
           if($parrentPolygon.length > 0) {
               let id = $parrentPolygon.data("id");                                
               let $tooltipCur = $(this).find('.tooltip[data-id=' + id + ']');                           
               let parentOffset = $(this).offset(); 
               $tooltipCur.css({
                   left: e.pageX - parentOffset.left,
                   top: e.pageY - parentOffset.top,                   
               })               
               $tooltips.addClass("hidden").removeClass("show")
               $tooltipCur.addClass("show").removeClass("hidden")
           }
           else {
               $tooltips.addClass("hidden").removeClass("show")
           }
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