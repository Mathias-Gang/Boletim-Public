<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Acessar_Ficha_do_Aluno"] or !isset($_SESSION["idGI"])) {
    header("Location: /");
    exit();
}
$a = $_GET["a"];
$statementA = "
    SELECT 
        conta.id AS id_conta,
        conta.nome,
        conta.email,
        conta.genero,
        conta.ativa,
        aluno.id AS id_aluno,
        aluno.idturmabobo AS id_turma,
        aluno.anoturmabobo AS ano_turma,
        aluno.codigo_aluno,
        aluno.matricula,
        aluno.email_pessoal,
        aluno.data_da_matricula,
        aluno.data_do_nascimento,
        aluno.data_da_saida,
        aluno.nacionalidade,
        aluno.naturalidade,
        aluno.cep,
        aluno.logradouro,
        aluno.bairro,
        aluno.cidade,
        aluno.estado,
        aluno.residencial,
        aluno.celular,
        aluno.rg,
        aluno.cpf,
        aluno.deficiencia,
        aluno.beneficio_social,
        aluno.observacoes,
        aluno.nome_rl1,
        aluno.nome_rl2,
        aluno.celular_rl1,
        aluno.celular_rl2,
        aluno.email_rl1,
        aluno.email_rl2 
    FROM aluno 
    LEFT JOIN conta ON
        conta.id = aluno.idConta 
    WHERE
        aluno.id = ?";
$paramA = array("i", $a);
$queryA = Query::execute($statementA, $paramA);
if ($queryA->num_rows == 0) {
    header("Location: /");
    exit();
}
$aluno = $queryA->fetch_object();

#$statementAT = "
#    SELECT
#        turma.id,
#        turma.ano FROM turma
#    LEFT JOIN rAlunoTurma ON
#        rAlunoTurma.idTurma = turma.idsis
#    WHERE rAlunoTurma.idAluno = ?";
#$queryAT = Query::execute($statementAT, $paramA);
#$aluno->turmas = array();
#while ($rowAT = $queryAT->fetch_object()) {
#    $aluno->turmas[] = $rowAT;
#}
$aluno = json_encode($aluno, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
echo $aluno;
?>