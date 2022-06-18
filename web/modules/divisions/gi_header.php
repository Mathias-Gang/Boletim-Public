<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
?>
<script src="js/header.js"></script>
<link rel="stylesheet" href="css/gi_header.css">

<div class="bar">
    <a href="/" class="header-home">
        <img src="img/home.png">
    </a>
    <div class="header-opcoes">
        <div class="header-opcoes-item">
            <p id="botao-card">Pesquisar<p>
        </div>
        <div class="header-opcoes-item">
            <a href="/modules/insert/aluno.php">Criar (imediato)<a>
        </div>
        <div class="header-opcoes-item">
            <a href="/planilha" style="color:white;">Planilha<a>
        </div>
        <div class="header-opcoes-item">
            <a href="/planilha_modulo" style="color:white;">Importação (imediato)<a>
        </div>
    </div>          
    <div class="perfil">
        <!-- Mostra as informações de login -->
        <img src="img/users/profile<?php echo $_SESSION['idConta']; ?>.png" onerror="usererror(this)" style="height: 34px; width: 34px; border-radius: 50%;">
        <div class="perfil-sub">
            <p id="nome_sessao" style="grid-area: perf-nome; font-size:11px;">
                <?php echo $_SESSION["nomeConta"]; ?>
            </p>
            <p style="font-size:10px;">
                ID: <?php echo $_SESSION["idConta"]; ?>
            </p>
            <p style="background-color: cornflowerblue; text-align: center;font-size:10px;">
                <?php echo "{$_SESSION["sessaoConta"]}"; ?>
            </p>
           <p style="grid-area: perf-deslog; font-size:10px;">
                <a href="modules/auth/deslogar.php">deslogar</a>
            </p>
        </div>
    </div>
</div>