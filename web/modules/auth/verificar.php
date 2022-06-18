<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/database/conexao.php");
session_start();
if (!isset($_SESSION["sessaoConta"])) {
    header("Location: /login");
    exit();
}
if (isset($_SESSION["sessaoConta"])) {
    $statement = "SELECT hora FROM sessao WHERE chave = ?";
    $param = array("s", session_id());
    $query = Query::execute($statement, $param);
    $row = $query->fetch_assoc();
    if ($query->num_rows != 1) {
        header("Location: /modules/auth/deslogar.php");
        exit();
    }
    $ultimoAcesso = DateTime::createFromFormat("Y-m-d H:i:s", $row["hora"], $timezone);
    $inatividade = $horaAgora->getTimeStamp() - $ultimoAcesso->getTimeStamp();
    if ($inatividade > 600) {
        header("Location: /modules/auth/deslogar.php");
        exit();
    }
    $statement = "UPDATE sessao SET hora = UTC_TIMESTAMP() WHERE chave = ?";
    Query::execute($statement, $param);
    $statement = "SELECT hora FROM sessao WHERE chave = ?";
    $query = Query::execute($statement, $param);
    $row = $query->fetch_assoc();
    $_SESSION["ultimoAcessoConta"] = DateTime::createFromFormat("Y-m-d H:i:s", $row["hora"], $timezone);
}
session_write_close();
?>