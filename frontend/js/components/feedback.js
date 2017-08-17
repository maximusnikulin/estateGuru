$(window).on('load',function(){
    var url = $('.form--feedback form').attr('action');
    $('.form--feedback form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        
        fetch('/contacts', {method:"POST",body:formData})
            .then(res => console.log(res.status))
    })
})