
class VisualView {
    constructor($target) {
        this.target = $target;       
    }
    injectTabs(model, fn) {
        let $trg = this.target.find('.js-visual-tabs');         
        model.forEach(el => {
            $trg.append(`
                <li class = "js-visual-tab section-switcher__tabs-tab" data-val = "${el}">${el}</li>
            `)
        });
        let $tabs = $(".js-visual-tab");        
        $tabs.on('click', this.handleChangeTab);                                                
        return this;
    }
    renderTabs(state) {                        
        let $tabs = $(".js-visual-tab");        
        $tabs.each(function(index){
            let $el = $(this)
            if (state.blockSection == $el.data('val')){
                $el.addClass('active');
            } else {
                $el.removeClass('active')
            }
        })
    }    
    injectLayouts(model) {        
        let $trg = this.target.find('.js-visual-contents');   
        Object.keys(model).forEach((keyBS) => {
            let $blockContent = $(`<li class = "js-visual-content" data-tab = "${keyBS}"></li>`);
            let $blockSlider = $(`<div class = "js-slider-visual"></div>`);
            $blockContent.append($blockSlider);
            Object.keys(model[keyBS]).forEach(keyLOC => {
                var location = model[keyBS][keyLOC];
                let $blockSliderItem = $(`
                    <div class = "js-slider-visual__item">
                        <div class="visual">                            
                            <div class= "visual__title">
                                <h2 class = "visual__title-main">Этажность</h2>
                                <span class = "visual__title-caption">${keyLOC}</span>
                            </div>
                            <div class="visual__content">
                                <figure class="visual__content-image">                                                                        
                                    <img src="${location.image}" alt=""/>
                                </figure>
                                <div class="visual__content-svgs">                                                                        
                                </div>
                                <div class="visual__content-tooltips">                                                                        
                                </div>
                            </div>
                        </div>
                    </div>
                `)
                let $blockSvgs = $blockSliderItem.find('.visual__content-svgs');
                let $blockTooltips = $blockSliderItem.find('.visual__content-tooltips');

                location.apartments.forEach((apart, indexApart) => {                        
                    $blockSvgs.append(`
                            <svg height="100%" width="100%">
                                <a href = "${apart.link}" >
                                    <path fill="#195463" d="${apart.svgPath}" data-id="${indexApart}"></path>
                                </a>
                            </svg>
                        `);
                    $blockTooltips.append(`
                        <div class="tooltip hidden" data-id = "${indexApart}">
                            <div class="tooltip__content">
                                <p class="row">
                                    Этаж: ${apart.floor}
                                </p>
                                <p class="row">
                                    Комнат: ${apart.rooms}
                                </p>
                                <p class="row">
                                    Площадь: ${apart.size}
                                </p>
                                <p class="row">
                                    Цена: ${apart.price} руб.
                                </p>
                                <p class="row">
                                    <a class = "link-to" href = "${apart.link}"> Перейти </a>
                                </p>
                            </div>
                        </div>   
                    `)
                })                
                $blockSlider.append($blockSliderItem);                
            });
            this.initSlider($blockSlider);                       
            $trg.append($blockContent);            
        });
        $(".js-slider-visual__item")
            .on("mousemove", function(e) {               
                if (e.target.nodeName == "path") {
                    let $el = $(e.target);
                    let id = $el.data('id');
                    let $tooltip = $(this).find(`.visual__content-tooltips > .tooltip[data-id=${id}]`);
                    $tooltip.removeClass('hidden');
                    $tooltip.css({
                        top:e.offsetY + "px",
                        left:e.offsetX + "px"
                    });
                } else {
                    let $tooltips = $(this).find(`.visual__content-tooltips > .tooltip`);
                    $tooltips.addClass("hidden")
                }
            })
        return this;
    }
    renderLayouts(state) {
        let $tabs = $(".js-visual-content");        
        $tabs.each(function() {
            let $el = $(this);
            if ($el.data("tab") == state.blockSection) {
                $el.show();
                $el.find(".js-slider-visual").slick('setPosition',0)
            } else {
                $el.hide()
            }
        });
    }
    render() {
        
    }
}

export default VisualView;
