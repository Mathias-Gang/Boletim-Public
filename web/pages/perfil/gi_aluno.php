<!DOCTYPE html>
<html lang="pt-BR">
	<head>
        <?php include_once("modules/session/tabInfo.php"); ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
        <script>const alunoJSON = '<?php include_once("modules/search/aluno.php"); ?>'</script>
        <script src="js/gi.js"></script>
        <script src="js/verificar.js"></script>
        <link rel="stylesheet" href="css/gi.css">
        <link rel="stylesheet" href="css/gi_ficha.css">
	</head>

	<body>
        <?php include_once("modules/divisions/CardPesquisa.php"); ?>
        <?php include_once("modules/divisions/gi_header.php"); ?>
        <div class="corpo">
            <form class="inf" id="inf" method="post" enctype="multipart/form-data" action="modules/update/aluno.php">            
                <div class="inf_div">
                    <label id='img_aluno_ref' class="opcao" style="grid-row: span 2;">
                        <a><img id="img_aluno"></a>
                    </label>
                    <label class="opcao" style="grid-row: span 2;">
                        <p>Nome</p>
                        <p id="nome">Carregando...</p>             
                    </label>
                    <label class="opcao">
                        <p>Código de Aluno ISERJ</p>
                        <textarea readonly id="id_aluno" name="id_aluno" style="word-wrap: break-word;"></textarea>
                    </label>
                    <label class="opcao">
                        <p>Login</p>
                        <p id="email">Carregando...</p>
                    </label>
                </div>
                <div class="inf_div">
                    <label class="opcao"  style="grid-column: span 2;" >
                        <p>Número de Matrícula</p>
                        <p id="matricula">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Data de Matrícula</p>
                        <p id="data_da_matricula">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Data de Saída</p>
                        <p id="data_da_saida">Carregando...</p>
                    </label>
                </div>                                
                <div class="inf_div" style="grid-template-columns: 100%; grid-row: span 2;">
                    <label class="opcao">
                        <p>CPF</p>
                        <p id="cpf">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>RG</p>
                        <p id="rg">Carregando...</p>
                    </label>
                </div>
                <div class="inf_div" style="grid-row: span 2;">
                    <label class="opcao">
                        <p>Data de Nascimento</p>
                        <p id="data_do_nascimento">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Gênero</p>
                        <p id="genero">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Nacionalidade</p>
                        <p id="nacionalidade">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Naturalidade</p>
                        <p id="naturalidade">Carregando...</p>
                    </label>
                </div>
                <div class="inf_div" style="grid-template-columns: 100%; grid-row: span 4; grid-template-rows: 45px auto auto auto; padding:  0 20px 20px 20px;">
                    <label style="display: flex; flex-direction: row; height: -webkit-fill-available; justify-self: center; width: calc(100% + 41px); border-bottom: solid #201453; user-select: none;"> <!-- sem 'class="opcao"'--> 
                        <p id="butt_resp_1" class="butt_resp">Responsável Legal 1</p>
                        <p id="butt_resp_2" class="butt_resp">Responsável Legal 2</p>
                    </label>
                    <label class="opcao">
                        <p>Nome (Responsável)</p>
                        <p id="nome_rl1">Carregando...</p>
                        <p id="nome_rl2">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>E-mail (Responsável)</p>
                        <p id="email_rl1">Carregando...</p>
                        <p id="email_rl2">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Telefone (Responsável)</p>
                        <p id="celular_rl1">Carregando...</p>
                        <p id="celular_rl2">Carregando...</p>
                    </label>
                </div>                
                <div class="inf_div" style="grid-template-columns: 100%; grid-row: span 2;">
                    <label class="opcao">
                        <p>E-mail Pessoal</p>
                        <p id="email_pessoal">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Telefone</p>
                        <p id="celular">Carregando...</p>
                    </label>
                </div> 
                <div class="inf_div" style=" grid-template-columns: 25% 25% 25% 25%; grid-column: span 2; grid-row: span 2;">
                    <label class="opcao" style="grid-column: span 2;">
                        <p>CEP</p>
                        <p id="cep">Carregando...</p>
                    </label>

                    <label class="opcao" style="grid-column: span 2;">
                        <p>Bairro</p>
                        <p id="bairro">Carregando...</p>
                    </label>
                    <label class="opcao">
                        <p>Estado</p>
                        <p id="estado">Carregando...</p>
                    </label>                   
                    <label class="opcao">
                        <p>Cidade</p>
                        <p id="cidade">Carregando...</p>
                    </label>
                    <label class="opcao" style="grid-column: span 2;">
                        <p>Logradouro</p>
                        <p id="logradouro">Carregando...</p>
                    </label>
                </div>
                <div class="inf_div" style="grid-template-columns: 100%; grid-row: span 2;">
                    <label class="opcao">
                        <p>idConta</p>
                        <textarea readonly id="id_conta" name="id_conta"></textarea>
                    </label>                   
                    <label class="opcao">
                        <p>Estado de Aluno</p>
                        <p id="ativa">Carregando...</p>
                    </label>
                </div>    
            </form>

            <div class="edit">Editando</div>
            <input class="butt salvar" form="inf" type="submit" id="updateAluno" value="Salvar"></input>
            
            <button class="butt deletar" value="Deletar">Deletar</button>
            <div class="butt editar" id="edit-d"></div>

        </div>
    </body>
    <script src="js/perfil/gi_ficha_view.js"></script>
</html>