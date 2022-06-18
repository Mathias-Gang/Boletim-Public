<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
    echo "Hora Agora<br>{$horaAgora->format("H:i:s d/m/Y")}<br><br>";
    $statement = "
        SELECT sessao.id, sessao.idConta, conta.nome, sessao.hora FROM sessao
        INNER JOIN conta ON conta.id = sessao.idConta WHERE 1 = ? ORDER BY sessao.hora DESC";
    $query = Query::execute($statement, array("i", 1));
    while ($row = $query->fetch_assoc()) {
        $horaLogin = DateTime::createFromFormat("Y-m-d H:i:s", $row["hora"], $timezone);
        $horaDeslogado = $horaAgora->getTimeStamp() - $horaLogin->getTimeStamp();
        if ($horaDeslogado < 6) {
            echo "1";
        }
        elseif ($horaDeslogado < 600) {
            echo "0";
        }
        else {
            break;
        }
        echo <<<HTML
            {$row["id"]} {$row["idConta"]} {$row["nome"]} {$horaLogin->format("H:i:s d/m/y")} <br>
        HTML;
    }
exit();
?>