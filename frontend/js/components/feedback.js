$(window).on('load',function(){
    var url = $('.form--feedback form').attr('action');
    $('.form--feedback form').on('submit', function(e){
        e.preventDefault();
        var formData = $(this).serialize();
        console.log(formData);
        $.post({
            url,
            content:formData,
            complete:function(){
                console.log("asdasdsad")
        }})
        // fetch(url, {method:"POST", body:formData})
        //     .then(res => console.log(res.status))
    })
})