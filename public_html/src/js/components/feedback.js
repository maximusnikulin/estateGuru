export const checkValidation = (body) => {
    const PATTERN_EMAIL = /^([A-Z|a-z|0-9](\.|_){0,1})+[A-Z|a-z|0-9]\@([A-Z|a-z|0-9])+((\.){0,1}[A-Z|a-z|0-9]){2}\.[a-z]{2,3}$/gm;
    var errors = {}    
    Object.keys(body).forEach(function(key){
        if(key.indexOf('[name]') !== -1) {            
            if (body[key] == '') {
                errors[key] = true;
            }
            return;
        }
        if(key.indexOf('[email]') !== -1) {
            if (!PATTERN_EMAIL.test(body[key]) || body[key] == '') {
                errors[key] = true;
            }
            return;
        }
        if(key.indexOf('[text]') !== -1) {
            if (body[key] == '') {
                errors[key] = true;
            }      
            return;      
        }        
    });
    return errors;
}


$(window).on('load',function(){

    var url = $('.form--feedback form').attr('action');

    $('.form--feedback form').on('submit', function(e){

        e.preventDefault();

        $(this).find('.popup__field').removeClass('popup__field--error');

        var fields = $(this).serializeArray();

        var body = {};

        fields.forEach(el => body[el.name] = el.value);
        
        var errors = checkValidation(body);
        
        if (Object.keys(errors).length) {
            console.log(errors);
            for (var key in errors) {       
                var selector = '.popup__field [name="' + key + '"]';
                $(this).find(selector).parent().addClass('popup__field--error');                
            }

        }
        else {
            $(this).find('.button').text('Отправка...')
            $(this).find('.popup__field input, .popup__field textarea').attr('disabled', true)
            $.ajax({
                type:'POST',
                url,
                data: body,
                success:function(e){
                    $('.form--feedback').hide()

                },
                error:function(e){
                    $('.form--feedback').hide()
                }
            });
        }
      
        
    });
});



