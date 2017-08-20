$('.section-subscribe__form-group').on('submit', function(e){
    e.preventDefault();
    var value = $(this).children('input').val();
    var pattern = /^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/gm
    
    if (pattern.test(value)) {
        $('.section-subscribe__form-group button').text('Отправка...');
        $.ajax({
            url:'/subscribe?email=' + value ,            
            success:function(){
                $('.section-subscribe__form-group').hide();
                $('.section-subscribe__title').hide();
                $('.section-subscribe__message').show()
            }
        })
    }

})