//meme do shydog
function shydog() {
    $('#shydog').fadeIn(400);
    $('#shydog').parent().delay(1200).slideUp(200);
    $('#shydog').delay(1250).fadeOut(400);
    cardpesq = false;
}

var cardpesq = false;

//ação de ativar card de pesquisa
function cardFadeIn() {
    $('.card').fadeIn(200);
    $('.card-background').fadeIn(250);
    $('#pesquisa-geral').focus();
    cardpesq = true;
}

//ação de desativar card de pesquisa
function cardFadeOut() {
    $('.card').fadeOut(200);
    $('.card-background').fadeOut(250); 
    cardpesq = false;
}

//triggers para as ações
$(document).ready(function(){
    $('#botao-card').click(cardFadeIn);
    //o atalho de alt+s ativará o card (caso ele esteja desativado) com 1 milissegundo de delay (evitando digitação do s no input)
    $(document).on('keydown', function(e){if (e.which == 83 && e.altKey && cardpesq == false) setTimeout(cardFadeIn, 1); });

    $('.card-background').click(cardFadeOut);
    //o atalho de alt+s desativará o card (caso ele esteja ativado)
    $(document).keydown(function(e){ if (e.key == 'Escape' || e.which == 83 && e.altKey && cardpesq == true) cardFadeOut();});
});

//manda o input e pega os resultados
function cardPesquisa(q) {
    //retorna nada, caso a barra esteja vazia
    if (q == '') { 
        $('#geral').html(''); 
    }

    else {
        $.ajax({
            method: "GET",
            url: "modules/search/cardPesquisa.php",
            data: {q: q},
            success: resultados,
        });
    }

    //meme do shydog
    if (q == 'shydog') {
        shydog();
    }
}

//exibe os resultados
function resultados(r) {
    //colar itens no console
    console.log(r);

    const resultados = JSON.parse(r)['itens'];
    $("#geral").empty();

    //colocar resultados no site
    for (let i = 1; i < resultados.length+1; i++) {
        let resultado = resultados[i-1];

        $("#geral")
            .append($("<a/>")
            .attr({
                href: resultado.tipoResultado+"-"+resultado.id,
            })
        );

            if (resultado.tipoResultado != "t") {

                $("#geral>a:nth-of-type("+i+")")
                    .append($("<img/>")
                    .attr({
                        src: "img/users/profile"+resultado.idConta+".png",
                        width: "35",
                        height: "35",
                        onerror: "usererror(this)",
                    })
                );

                $("#geral>a:nth-of-type("+i+")")
                    .append($("<div/>")
                );
    
                $("#geral>a:nth-of-type("+i+")>div")
                    .append($("<p/>")
                    .attr({
                        style: "font-size: 10px; grid-row: 1; grid-column: span 2",
                    })
                    .text(resultado.nome.toLowerCase())
                );

                $("#geral>a:nth-of-type("+i+")>div")
                    .append($("<p/>")
                    .attr({
                        style: "font-size: 10px; grid-row: 2; grid-column: 2;",
                    })
                    .text(resultado.idTurma+" ("+resultado.anoTurma+")")
                ); 
            } else {

                $("#geral>a:nth-of-type("+i+")")
                    .append($("<div/>")
                );

                $("#geral>a:nth-of-type("+i+")>div")
                    .append($("<p/>")
                    .attr({
                        style: "font-size: 10px; grid-row: 1; grid-column: span 2",
                    })
                    .text(resultado.turma)
                );
            }
        
            $("#geral>a:nth-of-type("+i+")>div")
                .append($("<p/>")
                .attr({
                    style: "font-size: 10px; grid-row: 2; grid-column: 1",
                })
                .text(resultado.tipoResultado+"-"+resultado.id)
            );
    }
    //$('#geral').html(text); ????
}
