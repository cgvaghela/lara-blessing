$(function () {
    //hide alert message when click on remove icon
    $(".close").click(function () {
        $(this).closest('.alert').addClass('hide');
    });
    
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });
    
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50){  
            $('.header').addClass("sticky");
        }
        else{
            $('.header').removeClass("sticky");
        }
    });
    
    var myFormDiv;

    //contact-form
    $("#contact-form-submit").click(function (e) {
        var $btn = $(this);
        myFormDiv = $("#contact-form").closest('div');
        e.preventDefault();
        if (!$(this).closest('form').valid()) {
            return false;
        }
        var formData = new FormData($("#contact-form")[0]);
        //var formData = $("#contact-form").serialize(),

        $.ajax({
            type: "POST",
            url: "/contact",
            data: formData,
            dataType: 'json',
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $btn.attr('disabled', true);
                myFormDiv.find('.alert .msg-content').html('');
                myFormDiv.find('.alert').addClass('hide');
            },
            success: function (resp) {
                if (resp.success) {
                    $("#contact-form")[0].reset();
                    $("#contact-form").validate().resetForm();

                    myFormDiv.find('.alert-success .msg-content').html(resp.message);
                    myFormDiv.find('.alert-success').removeClass('hide');

                } else {
                    myFormDiv.find('.alert-danger .msg-content').html(resp.message);
                    myFormDiv.find('.alert-danger').removeClass('hide');
                }
                $btn.attr('disabled', false);
            },
            error: function (e) {
                myFormDiv.find(".alert-danger msg").html('error: ' + JSON.stringify(e));
                myFormDiv.find('.alert-danger').removeClass('hide');
            }
        });
    });
    //end code
});