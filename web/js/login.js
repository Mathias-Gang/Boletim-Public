$(document).ready(function(){
    //ativação do submit
    $('input').on("input", function(){
        if($("#senha").val() && $("#email_inst").val() ){
            $('.submit').addClass("submit_enable");
            $('.submit').removeAttr('disabled');
        } else {
            $('.submit').removeClass("submit_enable");
            $('.submit').prop("disabled", "disabled");
        }
    });
    
    //
    /*$(document).click((this.value), function(b){
        if ($('#senha') == b) {
        $('#senha_div').css({"outline":"auto", "outline-color":"#757575"});
        $('#but_eye').css("display","block");
        } else {
             $('#senha_div').css({"outline":"", "outline-color":""});
        
            if(!$("#senha").val()){
            $('#but_eye').css("display","none");
            }
        }
    });*/

    // correto
    $('#senha').focus(function(){
        $('#senha_div').css({"outline":"auto", "outline-color":"#757575"});
        $('#but_eye').css("display","block");
    }).focusout(function(){
        $('#senha_div').css({"outline":"", "outline-color":""});

        if(!$('#but_eye').is(":hover") && !$("#senha").val()){
            $('#but_eye').css("display","none");
        }
    });

    $('#but_eye').click( function showsenha(){
        $('#senha').focus();
        if($('#but_eye[src="img/eye_visible.png"]').length) {
            $('#but_eye').prop("src", "img/eye_hide.png");
            $('#senha').prop("type", "text");
        } else {
            $('#but_eye').prop("src", "img/eye_visible.png");
            $('#senha').prop("type", "password");
        }
    });
});