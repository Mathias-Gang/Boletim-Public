<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Gestar_Informacoes_do_Aluno"]) {
    exit();
}
$statement = "INSERT INTO conta (tipo_conta) VALUES (?)";
$param = array("i", 1);
Query::execute($statement, $param);
$statement = "SELECT MAX(id) AS idAluno FROM aluno WHERE 1 = ?";
$query = Query::execute($statement, $param);
$row = $query->fetch_assoc();
$idAluno = $row["idAluno"];
header("Location: /a-{$idAluno}");
exit();
?>