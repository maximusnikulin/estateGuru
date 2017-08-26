$('.section-subscribe__form-group').on('submit', function(e){
    e.preventDefault();
    var value = $(this).children('input').val();
    var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;        
    $('.section-subscribe__form-group ').addClass('section-subscribe__form-group--error');
    if (pattern.test(value)) {
        $('.section-subscribe__form-group button').text('Отправка...');
        $('.section-subscribe__form-group button').prop("disabled", true);
        $.ajax({
            url:'/subscribe?email=' + value ,            
            success:function(res){
                var res = JSON.parse(res);                
                $('.section-subscribe__form-group').hide();
                $('.section-subscribe__title').hide();
                $('.section-subscribe__message').show()                
            }
        })
    }

})