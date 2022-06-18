<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Gestar_Informacoes_do_Aluno"]) {
    exit();
}
$idConta = $_POST["id_conta"];
$statement = "
    DELETE FROM aluno WHERE idConta = ?
    ";
$param = array("i", $idConta);
Query::execute($statement, $param);
$statement = "
    DELETE FROM conta WHERE id = ?
    ";
Query::execute($statement, $param);
header("Location: /");
exit();
?>