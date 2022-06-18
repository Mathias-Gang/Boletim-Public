$(document).ready(function(){
    $('input').on("input", function submit(){
        if($("#email_inst").val()) {
            $('.submit').addClass("submit_enable");
            $('.submit').removeAttr('disabled');
        }
        else {
            $('.submit').removeClass("submit_enable");
            $('.submit').prop("disabled", "disabled");
        }
    });
    
    $('#senha').focus(function senha() {
        $('#senha_div').css({"outline":"auto", "outline-color":"#757575"});
        $('#but_eye').css("display","block");
    });

    $('#senha').focusout(function senha2() {
        $('#senha_div').css({"outline":"", "outline-color":""});
        
        if(!$('#but_eye').is(":hover") && !$("#senha").val()) {
            $('#but_eye').css("display","none");
        }
    });

    $('#but_eye').click( function showsenha() {
        $('#senha').focus();
        if ($('#but_eye[src="img/eye_visible.png"]').length) {
            $('#but_eye').prop("src", "img/eye_hide.png");
            $('#senha').prop("type", "text");
        }
        else {
            $('#but_eye').prop("src", "img/eye_visible.png");
            $('#senha').prop("type", "password");
        }
    });
});