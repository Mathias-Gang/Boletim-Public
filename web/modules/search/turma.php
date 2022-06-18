<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Acessar_Ficha_da_Turma"]) {
    exit();
}
$t = $_GET["t"];
$statementT = "
    SELECT 
        idsis AS idsisTurma,
        id AS idTurma,
        ano AS anoTurma
    FROM turma
    WHERE
        idsis = ?";
$paramT = array("i", $t);
$queryT = Query::execute($statementT, $paramT);
if ($queryT->num_rows == 0) {
    header("Location: /");
    exit();
}
$turma = $queryT->fetch_object();
$statementRAT = "
    SELECT
        aluno.id AS idAluno,
        conta.nome AS nomeAluno
    FROM rAlunoTurma
    LEFT JOIN aluno ON
        aluno.id = rAlunoTurma.idAluno
    LEFT JOIN conta ON
        conta.id = aluno.idConta
    LEFT JOIN turma on
        turma.idsis = rAlunoTurma.idTurma
    WHERE turma.idsis = ?
    ORDER BY conta.nome";
$queryRAT = Query::execute($statementRAT, $paramT);
$turma->alunos = array();
while ($rowRAT = $queryRAT->fetch_object()) {
    $turma->alunos[] = $rowRAT;
}
$statementGH = "
    SELECT
        grade_horaria.id AS idGrade_horaria,
        professor.id AS idProfessor,
        conta.nome AS nomeProfessor,
        disciplina.nome AS disciplina,
        grade_horaria.dia_semana,
        tempo.id AS idTempo,
        tempo.horario AS hora,
        grade_horaria.sala
    FROM grade_horaria
    LEFT JOIN professor ON
        professor.id = grade_horaria.idProfessor
    LEFT JOIN conta ON
        conta.id = professor.idConta
    LEFT JOIN turma ON
        turma.idsis = grade_horaria.idTurma
    LEFT JOIN disciplina ON 
        disciplina.id = grade_horaria.idDisciplina
    LEFT JOIN tempo ON
        tempo.id = grade_horaria.idTempo
    WHERE
        grade_horaria.idTurma = ?
    ";
$queryGH = Query::execute($statementGH, $paramT);
$turma->grade_horaria = array();
while ($rowGH = $queryGH->fetch_object()) {
    $turma->grade_horaria[] = $rowGH;
}
$turma = json_encode($turma, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
echo $turma;
?>