<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <?php include_once("modules/session/tabInfo.php"); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>const professorJSON = '<?php include_once("modules/search/professor.php"); ?>'</script>
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
                <div class="inf_div">
                    <label id='img_aluno_ref' class="opcao" style="grid-row: span 2;">
                        <a><img id="img_aluno"></a>
                    </label>
                    <label class="opcao" style="grid-row: span 2;">
                        <p>Nome</p>
                        <p id="nome">Carregando...</p>             
                    </label>
                    <label class="opcao">
                        <p>Código de Professor</p>
                        <textarea readonly id="id_professor" name="id_aluno" style="word-wrap: break-word;"></textarea>
                    </label>
                    <label class="opcao">
                        <p>Login</p>
                        <p id="email">Carregando...</p>
                    </label>
                </div>
            </form>

            <div class="edit">Editando</div>
            <button class="butt salvar"></button>
            <div class="butt editar" id="edit-d"></div>

        </div>
    </body>
    <script src="js/perfil/gi_ficha_view.js"></script>
</html>