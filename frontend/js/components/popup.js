export const checkValidation = (body) => {
        console.log(body);
        var errors = {}    
        Object.keys(body).forEach(function(key){
            if(key.indexOf('[name]') !== -1) {            
                if (body[key] == '') {
                    errors[key] = true;
                }           
            }
            if(key.indexOf('[phone]') !== -1) {            
                if (body[key] == '') {
                    errors[key] = true;
                }             
            }
        })
        return errors;
}


 const TITLE_ERROR = `Произошла ошибка`;
 const MESSAGE_ERROR = `К сожалению наш сервис временно недоступен.</br>Мы уже устраняем проблему, попробуйте через 2 минуты.`;

 const TITLE_SUCCESS = `Заявка принята`;
 const MESSAGE_SUCCESS = `Спасибо за ваше обращение.</br>Наш оператор уже рассматривает вашу заявку.`;

 var $buttonsOpen = $('.js-callback');
 var $sectionCallback = $('.section-callback');
 var $popup = $('.section-callback > .section-callback__popup');

 var $formData = $('.section-callback > .section-callback__popup > .popup--data');

 var $formRes = $('.section-callback > .section-callback__popup > > .popup--result');
 var $formResTitle = $('.section-callback > .section-callback__popup > .popup--result > .popup__title > span');
 var $formResMessage = $('.section-callback > .section-callback__popup > .popup--result > .popup__message');

 var $buttonSend = $('.section-callback > .section-callback__popup > .popup  .popup__button');
 var $buttonClose = $('.section-callback > .section-callback__popup > .popup  .popup__close');
 var $fields = $('.section-callback > .section-callback__popup > .popup  .popup__field > input ');


 function cleanFields() {
     $fields.val('');
 }

 function insertTextToForm(success) {
     if (success) {
         cleanFields()
         $formResTitle.html(TITLE_SUCCESS);
         $formResMessage.html(MESSAGE_SUCCESS)
     } else {
         $formResTitle.html(TITLE_ERROR);
         $formResMessage.html(MESSAGE_ERROR);
     }
 }

 function showResult(success) {
     insertTextToForm(success);
     $sectionCallback.addClass('show-result')
 }

 $buttonsOpen.on('click', function () {
     $('body').addClass('frozen');
     $sectionCallback.addClass('show-data');
 })

 $formData.on('submit', function (e) {
     e.preventDefault();   
     $(this).find('.popup__field').removeClass('popup__field--error');
     var fields = $(this).serializeArray();
     var date = new Date();
     var time = date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
     console.log(time);
    //  $(this).find('.popup__field input[type="hidden"]').val(time);
     var body = {}; 
        fields.forEach(el => body[el.name] = el.value);         
        var errors = checkValidation(body);
        console.log(errors);
        if (Object.keys(errors).length) {            
            for (var key in errors) {       
                var selector = '.popup__field [name="' + key + '"]';
                $(this).find(selector).parent().addClass('popup__field--error');                
            }

        }
        else {
            $(this).find('.button').text('Отправка...')
            $(this).find('.popup__field input, .popup__field textarea').attr('disabled', true)
            var url = e.target.action;
            $.ajax({
                type:'POST',
                url,
                data: body,
                success:function(e){
                    showResult(true)

                },
                error:function(e){
                    showResult(false)
                }
            });
        }

 })
 $buttonClose.on('click', function (e) {
     $('body').removeClass('frozen')
     $sectionCallback.removeClass('show-data show-result');
 })
 $popup.on('click', function (e) {       
     if(e.target !== $formData && e.target !== $formRes) {
        $('body').removeClass('frozen')
        $sectionCallback.removeClass('show-data show-result');
     }
 })

$.merge($formData,$formRes).on('click', function(e){    
    e.stopPropagation();
})