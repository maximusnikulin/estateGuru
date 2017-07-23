
$(window).on('load', function(){
    var $links =  $('.js-navbar-cards > .section-tabs__switcher .link')
    var $content =  $('.js-navbar-cards > .section-tabs__content')
    $links.on('click' ,function(){
        var curID = $(this).data('id'); 
        console.log(curID);   
        var $allCards = $content.find(`.section-cards`);
        var $activeCards = $content.find(`.section-cards[data-id=${curID}]`);        
        $links.removeClass('active');
        $(this).addClass('active');
        $allCards.hide();
        $activeCards.show();
    })
})