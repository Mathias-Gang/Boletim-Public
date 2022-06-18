<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Acessar_Ficha_do_Professor"]) {
    exit();
}
$p = $_GET["p"];
$statementP = "
    SELECT 
        conta.id AS id_conta,
        conta.nome,
        conta.email,
        conta.genero,
        conta.ativa,
        professor.id AS id_professor,
        professor.codigo_professor,
        professor.matricula_ativa
    FROM professor 
    LEFT JOIN conta ON
        conta.id = professor.idConta 
    WHERE
        professor.id = ?";

$paramP = array("i", $p);
$queryP = Query::execute($statementP, $paramP);
if ($queryP->num_rows == 0) {
    header("Location: /");
    exit();
}
$professor = $queryP->fetch_object();
$statementGH = "
    SELECT
        grade_horaria.id AS idGrade_horaria,
        turma.idsis AS idsisTurma,
        turma.id AS idTurma,
        turma.ano AS anoTurma,
        disciplina.nome AS disciplina,
        grade_horaria.dia_semana,
        tempo.id AS idTempo,
        tempo.horario AS hora,
        grade_horaria.sala
    FROM grade_horaria
    LEFT JOIN turma ON
        turma.idsis = grade_horaria.idTurma
    LEFT JOIN disciplina ON 
        disciplina.id = grade_horaria.idDisciplina
    LEFT JOIN tempo ON
        tempo.id = grade_horaria.idTempo
    WHERE
        grade_horaria.idProfessor = ?
    ";
$queryGH = Query::execute($statementGH, $paramP);
$professor->turmas = array();
while ($rowGH = $queryGH->fetch_object()) {
    $professor->turmas[] = $rowGH;
}
$professor = json_encode($professor, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
echo $professor;
?>