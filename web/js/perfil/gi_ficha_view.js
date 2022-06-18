//divide os itens do json
var pag = (($(location).attr('href').split('/'))[3].split('-'))[0];
//console.log(pag);

const aa = [];

if (pag == 'a') aa.push(JSON.parse(alunoJSON));
if (pag == 'p') aa.push(JSON.parse(professorJSON));
if (pag == 't') aa.push(JSON.parse(turmaJSON));
const aluno = aa[0];
//console.log(aluno.turmas[0].ano);

//cria um array com os títulos dos itens do json
const at = Object.keys(aluno);
console.log(at);

//confere todos os itens

for (let x = 0; x < at.length; x++) {
    //classifica todos os itens vazios como 'null'
    if (aluno[at[x]] == '0000-00-00' || aluno[at[x]] == '') if (aluno[at[x]] != 0) aluno[at[x]] = null;

    //se ele for cpf, celular, matricula, cep, ele irá remover os símbolos
    if (aluno[at[x]] != null) if (/*at[x] == 'cpf' ||*/ at[x] == 'cep' || at[x] == 'celular' || at[x] == 'matricula' || at[x] == 'celular_rl1' || at[x] == 'celular_rl2') aluno[at[x]] = aluno[at[x]].replace(/[._ ()-]/g,'');

    //deixa 'estado' maiúsculo
    if (aluno[at[x]] != null && at[x] == 'estado') aluno[at[x]] = aluno[at[x]].toUpperCase();
    //torna as letras minúsculas (para formatação no css) caso seja texto
    else if (typeof aluno[at[x]] == 'string' ) aluno[at[x]] = aluno[at[x]].toLowerCase();
}
console.log(aluno);

//conteúdo dos itens vazios 
const vazio = 'Não Especificado';

//confere as especificações do item
function conf_item(i) {

    //confere se o item é 'null' (caso esteja, o preenche com 'vazio')
    if (aluno[at[i]] == null){
        return vazio;
    }
    //confere se o item é data (caso esteja, o formata corretamente)
    else if (at[i] == "data_da_matricula" || at[i] == "data_do_nascimento" || at[i] == "data_da_saida") {

        const date_exib = aluno[at[i]].split('-');
        let date_exib_formatado = '';
        date_exib.reverse();

        for (let x = 0; x < 3; x++) {
            date_exib_formatado += date_exib[x];
            if (x != 2) {
                date_exib_formatado += '/';
            }
        }
        return date_exib_formatado;
    }
    else return aluno[at[i]];
}

var edit_mode = false;

//alternancia entre os botões do rl
let rl = null;
function rl1(){
    //exibir rl1 e esconder rl2
    rl = true;
    //console.log(rl);
    $('#nome_rl1').show();
    $('#email_rl1').show();
    $('#celular_rl1').show();

    $('#nome_rl2').hide();
    $('#email_rl2').hide();
    $('#celular_rl2').hide();

    if (edit_mode){
        relatar($('#nome_rl1'));
        relatar($('#email_rl1'));
        relatar($('#celular_rl1'));
    }

    //vizual dos botões
    $('#butt_resp_1').css('background-color', '#201453');
    $('#butt_resp_2').css('background-color', '');
};
function rl2(){
    //exibir rl2 e esconder rl1
    rl = false;
    //console.log(rl);
    $('#nome_rl1').hide();
    $('#email_rl1').hide();
    $('#celular_rl1').hide();

    $('#nome_rl2').show();
    $('#email_rl2').show();
    $('#celular_rl2').show();

    if (edit_mode){
        relatar($('#nome_rl2'));
        relatar($('#email_rl2'));
        relatar($('#celular_rl2'));
    }

    //vizual dos botões
    $('#butt_resp_1').css( 'background-color', '');
    $('#butt_resp_2').css('background-color', '#201453');
}

//confere o campo no modo de edição
function relatar(campo) {
    
    $(campo).height('');
    $(campo)
    .height(function(){
            var a = '';
            if (!$(campo).val()) return 15;
            else return a;
    });

    //especificações da bolinha
    var siz = 10;
    var adicionado = 'chartreuse';
    var editado = 'yellow';
    var removido = 'red';

    $(campo).prevAll('p').children('svg').remove();

    //insere o valor do input em uma variavel para comparar depois com o original
    var campoval = $(campo).val();

    //se o valor do input for cpf, celular, matricula, cep, estado ele irá remover os símbolos
    if ($(campo).attr('id') == 'cpf' || $(campo).attr('id') == 'celular' || $(campo).attr('id') == 'matricula' || $(campo).attr('id') == 'cep' ||  $(campo).attr('id') == 'estado' || $(campo).attr('id') == 'celular_rl1' || $(campo).attr('id') == 'celular_rl2') {
        campoval = campoval.replace(/[._ ()-]/g,'');
        campoval = campoval.toUpperCase();
    }
    //deixa o valor do input minúsculo
    else {
        campoval = campoval.toLowerCase();
    }

    console.log(campoval + ' - ' + $(campo).attr('value') + ' (' + $(campo).attr('id') + ')');

    //confere quando o campo e o valor são diferentes, e classifica a situação 
    if (campoval != $(campo).attr('value')) {
        if ($(campo).attr('value')) {
            if (!campoval){
                $(campo).prevAll('p').append('<svg style="margin-left:5px; cursor: help;" width="'+ siz +'" height="'+ siz +'"> <title>Removido</title> <circle cx="'+ siz/2 +'" cy="'+ siz/2 +'" r="'+ siz/2 +'"fill="'+ removido +'"</circle> </svg>');
            } else {
                $(campo).prevAll('p').append('<svg style="margin-left:5px; cursor: help;" width="'+ siz +'" height="'+ siz +'"> <title>Editado</title> <circle cx="'+ siz/2 +'" cy="'+ siz/2 +'" r="'+ siz/2 +'"fill="'+ editado +'"</circle> </svg>');
            }
        } else {
            $(campo).prevAll('p').append('<svg style="margin-left:5px; cursor: help;" width="'+ siz +'" height="'+ siz +'"> <title>Adicionado</title> <circle cx="'+ siz/2 +'" cy="'+ siz/2 +'" r="'+ siz/2 +'"fill="'+ adicionado +'"</circle> </svg>');
        }
    }
}

// botões rl
    $('#butt_resp_1').click(rl1);
    $('#butt_resp_2').click(rl2);

// botões de modo de edição
$('#edit-d').click(function(){
    
    // sai do modo de edição
    if (edit_mode) view();

    // entra no modo de edição
    else edit();
});


// exibe o modo de vizualização, com rl1 exibido, sem o item de 'editando' - ao carregar
    //console.log(aluno['id_aluno']);
    view();
    $('#id_aluno').html(aluno['id_aluno']).inputmask("\\A-" + "9{1,}");
    $('#idsisTurma').html(aluno['idsisTurma']).inputmask("\\T-" + "9{1,}");
    $('#id_conta').html(aluno['id_conta']);
    rl1();
    $('.edit')
    .add('.salvar')
    .add('.deletar').hide();
    $('head>title')
    .append(function() {
        if (pag == 'a') return formatar(aluno.nome);
        if (pag == 'p') return formatar(aluno.nome);
        if (pag == 't') return aluno.idTurma + ' (' + aluno.anoTurma + ') ';
    })
    .append(
        ' ' + pag.toUpperCase() + '-'
    )
    .append(function(){
        if (pag == 'a') return aluno.id_aluno;
        if (pag == 'p') return aluno.id_professor;
        if (pag == 't') return aluno.idsisTurma;
    });

//ativa o modo de vizualização
function view() {
    edit_mode = false;
    $('.edit')
    .add('.salvar')
    .add('.deletar').fadeOut();
    $('.editar').empty().append('Editar');
    $('.opcao svg').remove();

    //estabelece os conteúdos
    for (let i = 0; i < at.length; i++){
        //console.log(at[i] + ': ' + aluno[at[i]]);

        if (at[i] == 'id_aluno' || at[i] == 'id_conta' || at[i] == 'idsisTurma') {}
        else {
        //define os itens como <p>
        $('#'+at[i])
        .empty()
        .replaceWith('<p id="'+ at[i] +'">Carregando...</p>');

        //insere os conteúdos
        $('#'+at[i]).html(conf_item(i));
        }
    }

    //inserções especiais
    $("#img_aluno").attr({
        src: "img/users/profile"+aluno.id_conta+".png",
        onerror: "usererror(this)",
    });
    $("#img_aluno_ref>a").attr({
        href: "img/users/profile"+aluno.id_conta+".png",
    });
    $("#img_aluno_ref input").remove();

    $('#ativa').html(function() {
        if (aluno.ativa == 1) return 'Ativo';
        else return 'Inativo';
    });

    $('#genero').html(function() {
        if (aluno.genero == 'm') return 'Masculino';
        else if (aluno.genero == 'f') return 'Feminino';
        else if (aluno.genero == 'o') return 'Outro';
        else return vazio;
    });

    //define um estilo para os itens sem nada
    $('p:contains("'+ vazio +'")').css({'color': 'mediumslateblue', "user-select": "none", "text-transform": "capitalize"});

    //exibe o rl atual ao carregar ao carregar
    if (rl) rl1();
    else rl2();

    if (aluno['cpf'] != null) $("#cpf").inputmask("999.999.999-99");
    if (aluno['matricula'] != null) $("#matricula").inputmask("999999.99.999999");
    if (aluno['cep'] != null) $("#cep").inputmask("99999-999");
    if (aluno['celular'] != null) $("#celular").inputmask("(99) 99999-9999");
    if (aluno['celular_rl1'] != null) $('#celular_rl1').inputmask("(99) 99999-9999");
    if (aluno['celular_rl2'] != null) $('#celular_rl2').inputmask("(99) 99999-9999");

    if (aluno['nome'] == null) edit();
}

//ativa o modo de edição
function edit() {
    edit_mode = true;
    $('.edit')
    .add('.salvar')
    .add('.deletar').fadeIn();
    $('.editar').empty().append('Sair');
    $('.opcao svg').remove();

    //estabelece os inputs
    for (let i = 0; i < at.length; i++){

        //pega os itens atuais para, depois, mante-los do mesmo tamanho
        var h_atual = $('#'+at[i]).height();

        //define os itens como inputs
        if (at[i] == 'id_aluno' || at[i] == 'id_conta' || at[i] == 'idsisTurma') {}
        else {
            var aluno_val = $('#'+at[i]).html();
            //console.log(aluno_val);

            $('#'+at[i])
            .empty()
            .replaceWith(function() {
                if (at[i] == 'data_do_nascimento' || at[i] == 'data_da_matricula' || at[i] == "data_da_saida") return '<input type="date" id="'+ at[i] +'">';
                else if (at[i] == 'email' || at[i] == 'email_pessoal' || at[i] == 'email_rl1' || at[i] == 'email_rl2') return '<input type="email" id="'+ at[i] +'">';
                    else if (at[i] == 'ativa') return '<select id="'+ at[i] +'" size="1"><option value="0">Inativo</option><option value="1">Ativo</option>';
                        else if (at[i] == 'genero') return '<select id="'+ at[i] +'" size="1"><option value="">Não Especificado</option><option value="m">Masculino</option><option value="f">Feminino</option><option value="o">Outro</option>';
                            else return '<textarea class="texts" id="'+ at[i] +'">';
            });

            //formata os inputs
            $('textarea#'+at[i])
            .add('input#'+at[i])
            .add('select#'+at[i])
            .attr({
                style: function(){
                    let date_style = '';
                    if ($(this).attr('type') == 'date') date_style = "display: grid; grid-template-columns: 48% auto; grid-template-rows: 100%;";
    
                    return date_style + "height:"+ h_atual +"px;";
                },
                name: at[i],
                placeholder: function() {
                    if (aluno[at[i]] != null) return aluno_val;
                    else return vazio;
                },
                //para inputs: caso já tenha conteúdo, já estabelece o valor
                value: function(){
                if (aluno[at[i]] != null) return aluno[at[i]];
                else return '';
                },
            })
            //para textareas: caso já tenha conteúdo, já estabelece o valor
            .append(function(){
                if (aluno[at[i]] == null) {}
                else return aluno[at[i]];
            });
            $('select#'+at[i] +' option[value*="'+ aluno[at[i]]+'"]').attr({selected: 'selected',});
        }
    }

    //inserções especiais
    $("#img_aluno")
    .css({
        'cursor': 'pointer',
    })
    .attr({
        src: "img/users/profile"+aluno.id_conta+".png",
        onerror: "usererror(this)",
    });
    $("#img_aluno_ref>a").removeAttr("href");
    $("#img_aluno_ref").append(
        '<input name="img_conta" style="display: none;" type="file" accept="image/*">'
    );

    $("#cpf").inputmask("999.999.999-99");
    $("#matricula").inputmask("999999.99.999999");
    $("#cep").inputmask("99999-999");
    $("#celular")
    .add('#celular_rl1')
    .add('#celular_rl2').inputmask("(99) 99999-9999");
    $("#id_turma")
    .add('#ano_turma')
    .inputmask("9{4}");
    $("#estado").inputmask("A{2}", {placeholder: ''});
    $("#rg").inputmask("9{1,14}", {placeholder: ''});

    //exibe o rl atual ao carregar ao carregar
    if (rl) rl1();
    else rl2();

    //quando o input é digitado ativa o 'relatar()'
    $('#inf textarea')
    .add('#inf input')
    .add('#inf select')
    .on('input', function() {
        relatar(this);
    })
    .on('change', function() {
        relatar(this);
    })
    .on('keypress', function(e) {
        if (e.which === 13) e.preventDefault();
    });

    $('#inf textarea')
    .add('#inf input')
    .add('#inf select')
    .attr({
        autocomplete: 'off',
    });

    $("#img_aluno_ref input").on('change', function() {
        var update_src = URL.createObjectURL(this.files[0]);

        $(this).prevAll('a').find('img').attr({
            src: update_src,
        });
    });

    $('.deletar').click(function(){
        $('#inf').attr({
            action:"modules/delete/aluno.php",
        });
        $('#inf').submit();
    });
}