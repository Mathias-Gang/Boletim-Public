<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");

require_once("pages/pesquisaDetalhada.php");
if (isset($_GET["nomeAluno"]) or isset($_GET["nomeProfessor"]) or isset($_GET["turma"])) {
    require_once("modules/search/pesquisa.php");
}
?>