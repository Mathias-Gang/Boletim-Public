<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
session_start();
if (isset($_GET["a"])) {
    require_once("pages/perfil/gi_aluno.php");
}
elseif (isset($_GET["p"])) {
    header("Location: /");
}
elseif (isset($_GET["t"])) {
    header("Location: /");
}
elseif (isset($_SESSION["idAluno"])) {
    header("Location: /");
}
elseif (isset($_SESSION["idProfessor"])) {
    header("Location: /");
}
elseif (isset($_SESSION["idGI"])) {
    require_once("pages/index/secretario.php");
}
exit();
?>