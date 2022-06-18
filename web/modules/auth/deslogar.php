<?php
require_once("../database/conexao.php");
session_start();
$statement = "DELETE FROM sessao WHERE chave = ?";
$i = session_id();
$param = array("i", $i);
Query::execute($statement, $param, "Deslogou", false);
session_regenerate_id();
session_destroy();
header("Location: /login");
exit();
?>