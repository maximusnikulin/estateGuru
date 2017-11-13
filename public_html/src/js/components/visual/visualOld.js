function getIsMobile() {
    return document.documentElement.offsetWidth < 1024;
}

function Visual(elem) {
    this.root = elem;    

    this.init = function(){
        this.positionTooltip();
    };
    this.injectSelects = function() {
        
    }
    this.positionTooltip = function() {
        let paths = this.root.find('.visual__polygons-lr > .polygon-svg path');
        let that = this;
        paths.each((index, el) => {
              let path_id = $(el).data("id");
              let tooltip = that.root.find('.visual__tooltips-lr > .tooltip[data-id="' + path_id + '"]');
              $(el).parent().on('click', function(e){
                  if (getIsMobile()) {
                    e.preventDefault();
                    console.log(e);
                    tooltip.toggleClass("hidden")
                    tooltip.css({
                          top:e.offsetY + "px",
                          left:e.offsetX + "px"
                      });
                  }
              });

              $(el).on('mousemove', function(e) {
                  if (getIsMobile()) {
                      return;
                  } else {
                      tooltip.css({
                          top:e.offsetY + "px",
                          left:e.offsetX + "px"
                      });
                  }
              })
              .on('mouseenter', function() {
                  if (getIsMobile()) {
                      return;
                  } else {
                      tooltip.removeClass('hidden');
                  }
              })
              .on('mouseleave', function() {
                  if (getIsMobile()) {
                      return;
                  } else {
                      tooltip.addClass('hidden');
                  }
              });
        });
    }
}



$(window).on('load', function(){
    var visual = new Visual($('.js-visual'))
    visual.init()
})