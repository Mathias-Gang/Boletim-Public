<?php
$timezone = new DateTimeZone("UTC");
$horaAgora = new DateTime("now", $timezone);
$horaAgora->setTimeStamp(time());
class Query {
    private static function conexao() {
        require("{$_SERVER['DOCUMENT_ROOT']}/modules/database/lista_conexoes.php");
        return $mysqli;
    }
    private static function log($statement, $param, $logStatement, $logParam) {
        if ($logParam === false) {
            $param = "";
        }
        elseif ($logParam === true) {
            unset($param[0]);
            array_values($param);
            $param = "| ".implode(" | ", $param)." |";
        }
        else {
            $param = $logParam;
        }
        if (is_string($logStatement)) {
            $statement = $logStatement;
        }
        $statementLog = "INSERT INTO registro(idConta, statement, parameters, hora) VALUES (?, ?, ?, UTC_TIMESTAMP())";
        $usuario = null;
        if (isset($_SESSION["idConta"])) {
            $usuario = $_SESSION["idConta"];
        }
        $paramLog = array("iss", $usuario, $statement, $param);
        self::execute($statementLog, $paramLog);
    }
    public static function execute($statement, $param, $logStatement = false, $logParam = true) {
        $queryResult = null;    
        $statement = preg_replace("/\s{2,}/", " ", $statement);
        $statement = preg_replace("/^\s*/", "", $statement);
        $mysqli = self::conexao();
        $pesquisa = $mysqli->prepare($statement);
        $pesquisa->bind_param(...$param);
        $pesquisa->execute();
        if (str_starts_with($statement, "SELECT")) {
            $queryResult = $pesquisa->get_result();
        }
        $mysqli->close();
        if ($logStatement !== false) {
            self::log($statement, $param, $logStatement, $logParam);
        }
        return $queryResult;
    }
}
?>