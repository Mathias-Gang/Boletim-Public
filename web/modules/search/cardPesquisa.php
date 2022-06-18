<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
$q = $_GET["q"];
if ($q == "" or !$_SESSION["Acessar_Ficha_do_Aluno"] or !isset($_SESSION["idGI"])){
    echo '{"itens":[],"tamanho":0}';
    exit();
}
$page = 0;
$q = preg_replace('/\s+/', ' ', $q);
$q = preg_replace('/\s$/', '', $q);

$qParam = explode(" ", $q);
$qL1 = array_slice($qParam, -1)[0];

$qL2 = "";
if (sizeof($qParam) > 1)  {
    $qL2 = array_slice($qParam, -2)[0];
}
if (!is_numeric($qL2) and is_numeric($qL1)) {
    $idTurma = $qL1;
    $anoTurma = "";
}
elseif (!is_numeric($qL2) and !is_numeric($qL1)) {
    $idTurma = "";
    $anoTurma = "";
}
elseif (is_numeric($qL2) and is_numeric($qL1)) {
    $idTurma = $qL2;
    $anoTurma = $qL1;
}

$nome = preg_replace("/( \d+)|(\d)| /", "", $q);

//Qualquer palavra
$x = "% {$nome}%";
//Primeira palavra
$y = "{$nome}%";

$statement = "
    SELECT
        conta.id AS idConta,
        aluno.id,
        conta.nome,
        conta.email,
        aluno.idturmabobo AS idTurma,
        aluno.anoturmabobo AS anoTurma,
        null AS classe_permissoes,
        'a' AS tipoResultado
    FROM aluno
    LEFT JOIN conta ON 
        conta.id = aluno.idConta
    LEFT JOIN rAlunoTurma ON
        rAlunoTurma.idAluno = aluno.id
    LEFT JOIN turma ON
        turma.idsis = rAlunoTurma.idTurma
    WHERE 
        (conta.nome LIKE ? OR
        conta.nome LIKE ? OR
        conta.email LIKE ?)
    GROUP BY nome

    ORDER BY CASE WHEN nome LIKE ? THEN 0 ELSE 1 END ASC, LENGTH(nome), nome ASC
    LIMIT ?, 100
    ";
$param = array("ssssi", $y, $x, $y, $y, $page);
$query = Query::execute($statement, $param, "Pesquisa Geral", $q);

$statementSize = "
    SELECT
        count(*) AS size
    FROM aluno
    LEFT JOIN conta ON
        conta.id = aluno.idConta
    WHERE
        (conta.nome LIKE ? OR
        conta.nome LIKE ? OR
        conta.email LIKE ?)
    ";
$paramSize = array("sss", $y, $x, $y);
$querySize = Query::execute($statementSize, $paramSize);
/*

/*if (is_null($nome)) {
    $statementT = "
        SELECT
            idsis AS id,
            id AS turma,
            ano,
            't' AS tipoResultado
        FROM turma
        WHERE 
            id REGEXP ? AND ano REGEXP ?
        LIMIT 5
        ";
    $paramT = array("ii", $idTurma, $anoTurma);
    $queryT = Query::execute($statementT, $paramT);

    $statementSizeT = "
        SELECT
            count(*) AS size
        FROM turma
        WHERE 
            id REGEXP ? AND ano REGEXP ?
        ";
    $paramSizeT = array("ii", $idTurma, $anoTurma);
    $querySizeT = Query::execute($statementSizeT, $paramSizeT);

    $arrayQuery[] = $queryT;
    $arraySizeQuery[] = $querySizeT;
}*/

$resultado = new stdClass();
$resultado->itens = array();
$resultado->tamanho = 0;

while ($rowSize = $querySize->fetch_object()) {
    $resultado->tamanho += $rowSize->size;
}
while ($row = $query->fetch_object()) {
    $resultado->itens[] = $row;
}
$resultado = json_encode($resultado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
echo $resultado;
?>