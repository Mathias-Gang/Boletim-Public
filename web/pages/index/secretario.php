<!DOCTYPE html>
<html lang="pt-BR">
	<head>
        <title>Entrada</title>
        <?php include_once("modules/session/tabInfo.php");?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="js/gi.js"></script>
        <script src="js/contasLogadas.js"></script>
        <script src="js/verificar.js"></script>
        <link rel="stylesheet" href="css/gi.css">
        <link rel="stylesheet" href="css/gi_principal.css">
	</head>

	<body>
        <?php include_once("modules/divisions/CardPesquisa.php"); ?>
        <?php include_once("modules/divisions/gi_header.php"); ?>
		<div class="corpo">
            <div class="inserirConta">
                <form method="post" action="modules/insert/inserirConta.php">
                    <input class="texto" placeholder="Nome" name="nome" type="text"><br>
                    <input class="texto" placeholder="Email" name="email" type="text"><br>
                    <input class="texto" placeholder="Senha" name="senha" type="text"><br><br>
                    <div style="background-color: white;">
                        <input type="radio" name="tipo" value="1" checked="checked">aluno<br>
                        <input type="radio" name="tipo" value="2">professor<br>
                        <input type="radio" name="tipo" value="3">secretario<br>
                        <input type="radio" name="tipo" value="4">administrador<br>
                        <input type="radio" name="tipo" value="5">nepem
                    </div>
                    <br><input style="display: block; margin: 0 auto; border: none; height: 25px;" type="submit" value="Cadastrar conta">
                </form>
            </div>
            <div class="sessoes">
                <p>sessões</p>
                <div id="contasLogadas">
                    <!-- -->
                </div> 
            </div>
		</div>
	</body>
</html>