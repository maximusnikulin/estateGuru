 function randomIntervalInclude(min, max) {
     var random = min + Math.random() * (max + 1 - min);
     return +Math.floor(random).toFixed(2);
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
     $('body').addClass('frozen')
     $sectionCallback.addClass('show-data');
 })
 $buttonSend.on('click', function (e) {
     e.preventDefault();
     let rnd = Math.round(Math.random());
     showResult(rnd)
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