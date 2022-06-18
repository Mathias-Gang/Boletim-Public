$(document).ready(function(){
    $('input').on("input", function submit(){
        if($("#senha").val() && $("#confirmarSenha").val()) {
            $('.submit').addClass("submit_enable");
            $('.submit').removeAttr('disabled');
        }
        else {
            $('.submit').removeClass("submit_enable");
            $('.submit').prop("disabled", "disabled");
        }
    })
});