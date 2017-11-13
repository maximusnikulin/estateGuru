class VisualController {
    constructor(model, view) {
        this.model = model;
        this.view =  view;
    }
    init() {
        this.initTabs();
        this.initLocations()
    }
    initTabs() {        
        this.view.handleChangeTab = this.handleChangeTab.bind(this);                
        this.view
            .injectTabs(this.model.getBlocksKeys())
            .renderTabs(this.model.getState());                
    }
    initLocations() {
        this.view.initSlider = this.initSlider;
        this.view
            .injectLayouts(this.model.getLocations())
            .renderLayouts(this.model.getState())                
    }
    initSlider($target) {
        $target.slick({
            slidesToShow:1,
            slidesToScroll:1,
            infinite:false,
            accessibility:false,
            focusOnSelect:false,
            focusOnClick:false,
            touchMove:false,
            swipe:false,
            nextArrow: `<button class = "arrow arrow--next"></button>`,
            prevArrow: `<button class = "arrow arrow--prev"></button>`,
        })
    }
    handleChangeTab(e) {
        let nextVal = $(e.target).data('val');
        // # 1 #
        // this.model.setBlockSection(nextVal, this.view.renderTabs(this.model.getBlocks()));        
        // # 2 #         
        this.model.setBlockSection(nextVal, this.view.renderTabs, this.view.renderLayouts);                
    }    
    
}

export default VisualController;