<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");

function statementBuild($colunas, $param, $statement) {
    for ($i = 0; $i < count($colunas); $i++) {
        if ($param[$i+1] == "%%" or $param[$i+1] == "%" or $param[$i+1] == "") {
            $statement .= " AND '' LIKE ?";
        }
        elseif (($colunas[$i] == "conta.gênero" or $colunas[$i] == "aluno.disc_deficienia" or $colunas[$i] == "aluno.disc_bene_soc") and $param[$i+1] == "2") {
            $statement .= " AND 2 = ?";
        }
        else {
            $statement .= " AND {$colunas[$i]} LIKE ?";
        }
    }
    return $statement;
}
function pesquisaAluno(
    $nome, $turma, $anoTurma, $matricula, $data_da_matricula, $data_da_saida, 
    $CPF, $genero, $nacionalidade, $naturalidade, $responsavel_legal1, $email,
    $celular, $disc_deficiencia, $disc_bene_social) {
    $colunas = array(
        "conta.nome", "rAlunoTurma.idTurma", "rAlunoTurma.anoTurma", "aluno.matricula",
        "aluno.data_da_matricula", "aluno.data_da_saida", "aluno.CPF", "conta.gênero", "aluno.nacionalidade",
        "aluno.naturalidade", "aluno.resposavel_legal1", "conta.email", "aluno.celular",
        "aluno.disc_deficienia", "aluno.disc_bene_soc");
    $param = array("sssssssssssssss",
        $nome, $turma, $anoTurma, $matricula, $data_da_matricula,
        $data_da_saida, $CPF, $genero, $nacionalidade, $naturalidade,
        $responsavel_legal1, $email, $celular, $disc_deficiencia, $disc_bene_social);
    $statement = "
        SELECT * FROM aluno
        LEFT JOIN conta ON conta.id = aluno.idConta
        LEFT JOIN rAlunoTurma ON rAlunoTurma.idAluno = aluno.id
        WHERE 1 = 1";
    $statement = statementBuild($colunas, $param, $statement);
    return Query::execute($statement, $param, "Pesquisa Aluno");
}
function pesquisaProfessor($nome, $email) {
    $colunas = array(
        "conta.nome",
        "conta.email");
    $param = array("ss",
        $nome,
        $email);
    $statement = "
        SELECT conta.id, conta.nome, conta.email, tipo_conta.disc_tipo AS tipo_conta FROM professor
        LEFT JOIN conta ON conta.id = professor.idConta
        LEFT JOIN tipo_conta ON tipo_conta.id_tipo = conta.tipo_conta
        WHERE 1 = 1";
    $statement = statementBuild($colunas, $param, $statement);
    return Query::execute($statement, $param, "Pesquisa professor");
}
function pesquisaTurma($turma, $anoTurma) {
    $resultado = array();
    $statement = "
        SELECT idsis, id, ano FROM turma
        WHERE 1=1
        AND id LIKE ?
        AND ano LIKE ?";
    $param = array("ss", $turma, $anoTurma);
    return Query::execute($statement, $param, "Pesquisa turma");
}

if (isset($_GET["nomeAluno"])){
    $query = pesquisaAluno(
        "%{$_GET["nomeAluno"]}%",
        "{$_GET["turmaAluno"]}",
        "{$_GET["anoTurmaAluno"]}", 
        "{$_GET["matriculaAluno"]}",
        "{$_GET["data_da_matriculaAluno"]}",
        "{$_GET["data_da_saidaAluno"]}",
        "{$_GET["CPFAluno"]}",
        "{$_GET["generoAluno"]}",
        "%{$_GET["nacionalidadeAluno"]}%",
        "%{$_GET["naturalidadeAluno"]}%",
        "%{$_GET["responsavel_legal1Aluno"]}%",
        "{$_GET["emailAluno"]}%",
        //Se colocado somente o DDD ((19) 00000-0000) o REGEX remove todo o resto do número e deixa somente "19" para aparecerem resultados com base no DDD.
        preg_replace("/((\(00\))? 0*-0*$)|([^0-9])/", "", $_GET["celularAluno"])."%",
        "{$_GET["deficiencia_terAluno"]}",
        "{$_GET["beneficios_sociaisAluno"]}");
}
elseif (isset($_GET["nomeProfessor"])){
    $query = pesquisaProfessor(
        "%{$_GET["nomeProfessor"]}%",
        "{$_GET["emailProfessor"]}%");
}
elseif (isset($_GET["turma"])) {
    $query = pesquisaTurma(
        "{$_GET["turma"]}%",
        "{$_GET["anoTurma"]}%");
}

$resultado = array();
while ($row = $query->fetch_object()) {
    $resultado[] = $row;
}
$resultado = json_encode($resultado, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK); 
echo $resultado;
?>