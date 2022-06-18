<?php 
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php"); 
?>
<script src="js/cardPesquisa.js"></script>
<link rel="stylesheet" href="css/gi_cardpesquisa.css">

<div class="card-background"></div>

<div class="card">
    <form class="pesquisaGeral" method="GET">
		<input id="pesquisa-geral" class="texto" oninput="cardPesquisa(this.value)" list="geral" autocomplete="off" placeholder="Pesquisar">
    </form>
    <div class="pesquisa" id="geral">
       <!-- modules/search/cardPesquisa.php -->
    </div>
    <img id="shydog" style=" display: none;" src="../img/users/profile4.png"><img>
</div>
<script type="text/javascript">$('#shydog').hide();</script>