<?php
require_once("{$_SERVER['DOCUMENT_ROOT']}/modules/auth/verificar.php");
if (!$_SESSION["Gestar_Informacoes_do_Aluno"]) {
    exit();
}

$id_conta = $_POST["id_conta"];
$nome = $_POST["nome"];
$email = $_POST["email"];
$genero = $_POST["genero"];
$ativa = $_POST["ativa"];
$id_aluno = preg_replace("/[^\d]/", "", $_POST["id_aluno"]);
if ($_FILES["img_conta"]["tmp_name"] != "") {
    move_uploaded_file($_FILES["img_conta"]["tmp_name"], "../../img/users/profile".$id_conta.".png");
}
#$codigo_aluno = $_POST["codigo_aluno"];
$matricula = $_POST["matricula"];
$email_pessoal = $_POST["email_pessoal"];
$data_da_matricula = $_POST["data_da_matricula"];
$data_do_nascimento = $_POST["data_do_nascimento"];
$data_da_saida = $_POST["data_da_saida"];
$idturmabobo = $_POST["id_turma"];
$anoturmabobo = $_POST["ano_turma"];
$nacionalidade = $_POST["nacionalidade"];
$naturalidade = $_POST["naturalidade"];
$cep = $_POST["cep"];
$logradouro = $_POST["logradouro"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
#$residencial = $_POST["residencial"];
$celular = $_POST["celular"];
$rg = $_POST["rg"];
$cpf = preg_replace("/[^\d]/", "", $_POST["cpf"]);
#$deficiencia = $_POST["deficiencia"];
#$beneficio_social = $_POST["beneficio_social"];
#$observacoes = $_POST["observacoes"];
$nome_rl1 = $_POST["nome_rl1"];
$nome_rl2 = $_POST["nome_rl2"];
$celular_rl1 = $_POST["celular_rl1"];
$celular_rl2 = $_POST["celular_rl2"];
$email_rl1 = $_POST["email_rl1"];
$email_rl2 = $_POST["email_rl2"];
$statementAluno = "
    UPDATE aluno
    LEFT JOIN conta ON
        conta.id = aluno.idConta 
    SET
        conta.nome = NULLIF(?, ''),
        conta.email = NULLIF(?, ''),
        conta.genero = NULLIF(?, ''),
        conta.ativa = NULLIF(?, ''),
        aluno.matricula = NULLIF(?, ''),
        aluno.email_pessoal = NULLIF(?, ''),
        aluno.data_da_matricula = NULLIF(?, ''),
        aluno.data_do_nascimento = NULLIF(?, ''),
        aluno.data_da_saida = NULLIF(?, ''),
        aluno.idturmabobo = NULLIF(?, ''),
        aluno.anoturmabobo = NULLIF(?, ''),
        aluno.nacionalidade = NULLIF(?, ''),
        aluno.naturalidade = NULLIF(?, ''),
        aluno.cep = NULLIF(?, ''),
        aluno.logradouro = NULLIF(?, ''),
        aluno.bairro = NULLIF(?, ''),
        aluno.cidade = NULLIF(?, ''),
        aluno.estado = NULLIF(?, ''),
        aluno.celular = NULLIF(?, ''),
        aluno.rg = NULLIF(?, ''),
        aluno.cpf = NULLIF(?, ''),
        aluno.nome_rl1 = NULLIF(?, ''),
        aluno.nome_rl2 = NULLIF(?, ''),
        aluno.celular_rl1 = NULLIF(?, ''),
        aluno.celular_rl2 = NULLIF(?, ''),
        aluno.email_rl1 = NULLIF(?, ''),
        aluno.email_rl2 = NULLIF(?, '')
    WHERE
        aluno.id = ?";
$param = array("sssssssssssssssssssssssssssi", $nome, $email, $genero, $ativa, $matricula, $email_pessoal, $data_da_matricula, $data_do_nascimento, $data_da_saida, $idturmabobo, $anoturmabobo, $nacionalidade, $naturalidade, $cep, $logradouro, $bairro, $cidade, $estado, $celular, $rg, $cpf, $nome_rl1, $nome_rl2, $celular_rl1, $celular_rl2, $email_rl1, $email_rl2, $id_aluno);
$queryAluno = Query::execute($statementAluno, $param, "Editar aluno");
header("Location: /a-".$id_aluno);
exit();
?>