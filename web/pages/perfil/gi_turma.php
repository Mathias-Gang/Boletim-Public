<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php include_once("modules/session/tabInfo.php"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>const turmaJSON = '<?php include_once("modules/search/turma.php"); ?>'</script>
        <script src="js/gi.js"></script>
        <script src="js/verificar.js"></script>
        <link rel="stylesheet" href="css/gi.css">
        <link rel="stylesheet" href="css/gi_ficha.css">
    </head>

    <body>
        <?php include_once("modules/divisions/CardPesquisa.php"); ?>
        <?php include_once("modules/divisions/gi_header.php"); ?>
        <div class="corpo">
            <form class="inf" method="post" action="modules/update/aluno.php">
                <div class="inf_div" style=" grid-template-columns: 50% 50%; grid-template-rows: auto; grid-column: span 1;">
                    <label class="opcao">
                        <p>Turma</p>
                        <p id="idTurma">Carregando...</p>             
                    </label>
                    <label class="opcao">
                        <p>Ano</p>
                        <p id="anoTurma">Carregando...</p>             
                    </label>
                    <label class="opcao" style="grid-column: span 2;">
                        <p>Código de Turma</p>
                        <textarea readonly id="idsisTurma" name="idsisTurma" style="word-wrap: break-word;"></textarea>
                    </label>
                </div>
            </form>

            <div class="edit">Editando</div>
            <input class="butt salvar" form="inf" type="submit" id="updateAluno" value="Salvar"></input>
            <div class="butt editar" id="edit-d"></div>

        </div>
    </body>
    <script src="js/perfil/gi_ficha_view.js"></script>
</html>