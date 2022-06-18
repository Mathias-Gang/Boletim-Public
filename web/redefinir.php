<?php
session_start();
if (isset($_SESSION["sessaoConta"])) {
    header("Location: /");
    exit();
}
elseif (isset($_GET["q"])) {
    $q = $_GET["q"];
    require_once("modules/database/conexao.php");
    $statement = "
        SELECT
            emailConta, chave, validade
        FROM redefinirSenha
        WHERE
            chave = ?
        ";
    $param = array("s", $q);
    $query = Query::execute($statement, $param);
    if ($query->num_rows == 1) {
        $row = $query->fetch_assoc();
        $validade = DateTime::createFromFormat("Y-m-d H:i:s", $row["validade"], $timezone);
        $valido = $horaAgora->getTimeStamp() - $validade->getTimeStamp();
        echo $valido;
        if ($valido < 180) {
            $email = $row["emailConta"];
            require_once("pages/redefinirSenha.php");
            exit();
        }
        elseif ($valido > 180) {
            $statementDelete = "
                DELETE FROM redefinirSenha
                WHERE
                    chave = ?
                ";
            $paramDelete = array("s", $row["chave"]);
            Query::execute($statementDelete, $paramDelete);
        }
    }
    header("Location: /redefinir");
    exit();
}
elseif (!isset($_GET["q"])) {
    require_once("pages/requestRedefinicao.php");
    exit();  
}
?>