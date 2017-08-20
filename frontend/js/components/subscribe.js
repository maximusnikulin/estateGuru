$('.section-subscribe__form-group').on('submit', function(e){
    e.preventDefault();
    var value = $(this).children('input').val();
    var pattern = /^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/gm
    if (pattern.test(value)) {
        $.ajax({
            url:'/subscribe?email=' + value ,            
            success:function(){
                console.log('asdasd')
            }
        })
    }

})