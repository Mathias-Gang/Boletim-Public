<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
$statement = "
    SELECT registro.id, registro.idConta, conta.nome, registro.statement, registro.parameters, registro.hora FROM registro
    LEFT JOIN conta ON conta.id = registro.idConta
    WHERE 1 = ? ORDER BY id DESC LIMIT 100";
$param = array("i", 1);
$query = Query::execute($statement, $param);
while ($row = $query->fetch_assoc()) {
    echo <<<HTML
    {$row["idConta"]} {$row["nome"]} {$row["hora"]}<br>{$row["statement"]}<br>{$row["parameters"]}<br><br>
    HTML;
}
?>