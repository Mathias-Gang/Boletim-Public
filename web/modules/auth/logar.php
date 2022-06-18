<?php
require_once("../database/conexao.php");
$recaptcha = JSON_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfUsfMcAAAAANe2Y_8dfPvaVm0w_BITfU9m3XNP&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']));
if ($_SERVER["REQUEST_METHOD"] === "POST" and $recaptcha->success) {
    $email = $_POST["email"];
    $senha = md5($_POST["senha"]);
    $statement = "SELECT id, nome, tipo_conta FROM conta WHERE email = ? AND senha = ?";
    $param = array("ss", $email, $senha);
    $query = Query::execute($statement, $param, "Tentativa de login", $email);
    if ($query->num_rows == 1) {
        $row = $query->fetch_assoc(); 
        session_start();
        session_destroy();
        session_start();
        session_regenerate_id();
        $_SESSION["idConta"] = $row["id"]; 
        $_SESSION["nomeConta"] = $row["nome"];
        if ($row["tipo_conta"] == 1) {
            $statementAluno = "SELECT id FROM aluno WHERE idConta = ?";
            $paramAluno = array("i", $row["id"]);
            $queryAluno = Query::execute($statementAluno, $paramAluno);
            $rowAluno = $queryAluno->fetch_assoc();
            $_SESSION["idAluno"] == $rowAluno["id"];
        }
        if ($row["tipo_conta"] == 2) {
            $statementProfessor = "SELECT id FROM professor WHERE idConta = ?";
            $paramProfessor = array("i", $row["id"]);
            $queryProfessor = Query::execute($statementAluno, $paramAluno);
            $rowProfessor = $queryProfessor->fetch_assoc();
            $_SESSION["idProfessor"] == $rowProfessor["id"];
        }
        if ($row["tipo_conta"] == 3) {
            $statementGI = "SELECT id FROM gestao_interna WHERE idConta = ?";
            $paramGI = array("i", $row["id"]);
            $queryGI = Query::execute($statementGI, $paramGI);
            $rowGI = $queryGI->fetch_assoc();
            $_SESSION["idGI"] = $rowGI["id"];
            $statementGI = "
                SELECT
                    permissoes.classe, 
                    permissoes.Acessar_Ficha_do_Aluno,
                    permissoes.Gestar_Informacoes_do_Aluno,
                    permissoes.Acessar_Login_aluno,
                    permissoes.Gestar_Login_aluno,
                    permissoes.Acessar_Boletim,
                    permissoes.Gestar_Boletim,
                    permissoes.Enturmar_Aluno,
                    permissoes.Acessar_Ficha_do_Professor,
                    permissoes.Gestar_Informacoes_do_Professor,
                    permissoes.Acessar_Login_professor,
                    permissoes.Gestar_Login_professor,
                    permissoes.Acessar_Ficha_da_Turma,
                    permissoes.Gestar_Informacoes_da_Turma,
                    permissoes.Criar_Horario 
                FROM gestao_interna
                    LEFT JOIN permissoes ON permissoes.classe = gestao_interna.classe_permissoes
                WHERE gestao_interna.id = ?
                ";
            $paramGI = array("i", $rowGI["id"]);
            $queryGI = Query::execute($statementGI, $paramGI);
            $rowGI = $queryGI->fetch_assoc();
            $_SESSION["Acessar_Ficha_do_Aluno"] = $rowGI["Acessar_Ficha_do_Aluno"];
            $_SESSION["Gestar_Informacoes_do_Aluno"] = $rowGI["Gestar_Informacoes_do_Aluno"];
            #$_SESSION["Acessar_Login_aluno"] = $rowGI["Acessar_Login_aluno"];
            #$_SESSION["Gestar_Login_aluno"] = $rowGI["Gestar_Login_aluno"];
            #$_SESSION["Acessar_Boletim"] = $rowGI["Acessar_Boletim"];
            #$_SESSION["Gestar_Boletim"] = $rowGI["Gestar_Boletim"];
            #$_SESSION["Enturmar_Aluno"] = $rowGI["Enturmar_Aluno"];
            $_SESSION["Acessar_Ficha_do_Professor"] = $rowGI["Acessar_Ficha_do_Professor"];
            $_SESSION["Gestar_Informacoes_do_Professor"] = $rowGI["Gestar_Informacoes_do_Professor"];
            #$_SESSION["Acessar_Login_professor"] = $rowGI["Acessar_Login_professor"];
            #$_SESSION["Gestar_Login_professor"] = $rowGI["Gestar_Login_professor"];
            $_SESSION["Acessar_Ficha_da_Turma"] = $rowGI["Acessar_Ficha_da_Turma"];
            $_SESSION["Gestar_Informacoes_da_Turma"] = $rowGI["Gestar_Informacoes_da_Turma"];
            #$_SESSION["Criar_Horario"] = $rowGI["Criar_Horario"];
        }

        $statement = "INSERT INTO sessao(idConta, chave, hora) VALUES (?, ?, UTC_TIMESTAMP())";
        $param = array("is", $row["id"], session_id());
        Query::execute($statement, $param, "Usuário logado", false);

        $statement = "SELECT id, hora FROM sessao WHERE chave = ?";
        $param = array("s", session_id());
        $query = Query::execute($statement, $param);

        $row = $query->fetch_assoc();
        $_SESSION["sessaoConta"] = $row["id"];
        $_SESSION["ultimoAcessoConta"] = DateTime::createFromFormat("Y-m-d H:i:s", $row["hora"]);
    }
}
header("Location: /");
exit();
?>