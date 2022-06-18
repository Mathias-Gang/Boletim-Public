<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!isset($_SESSION["idGI"])) {
    exit();
    header("Location: /");
}
//Insere uma conta dentro do sistema. Provisório
$nome = $_POST["nome"];
$email = $_POST["email"];
$senha = md5($_POST["senha"]);
$tipo = $_POST["tipo"];

if ((!$_SESSION["Gestar_Informacoes_do_Aluno"] and $tipo == 1) or
    (!$_SESSION["Gestar_Informacoes_do_Professor"] and $tipo == 2) or
    ($tipo != 1 and $tipo !=2)) {
    header("Location: /");
    exit();
}
$statement = "INSERT INTO conta(email, nome, senha, tipo_conta) VALUES (?, ?, ?, ?)";
$param = array("sssi", $email, $nome, $senha, $tipo);
Query::execute($statement, $param);
header("Location: /");
exit();
?>