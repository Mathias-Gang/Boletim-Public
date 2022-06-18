<?php
require_once("../database/conexao.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require("../../vendor/autoload.php");

$recaptcha = JSON_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfUsfMcAAAAANe2Y_8dfPvaVm0w_BITfU9m3XNP&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']));
if ($_SERVER["REQUEST_METHOD"] === "POST" and $recaptcha->success) {
    $chave = $_POST["chave"];
    $senha = $_POST["senha"];
    $confirmarSenha = $_POST["confirmarSenha"];
    $statement = "
        SELECT 
            emailConta, chave, validade
        FROM redefinirSenha
        WHERE
            chave = ?
        ";
    $param = array("s", $chave);
    $query = Query::execute($statement, $param);
    if ($query->num_rows == 1) {
        $row = $query->fetch_assoc();
        $validade = DateTime::createFromFormat("Y-m-d H:i:s", $row["validade"], $timezone);
        $valido = $horaAgora->getTimeStamp() - $validade->getTimeStamp();
        if ($valido < 180 and $senha === $confirmarSenha) {
            $statementUpdate = "
                UPDATE conta
                SET
                    senha = ?
                WHERE
                    email = ?
                ";
            $paramUpdate = array("ss", md5($senha), $row["emailConta"]);
            Query::execute($statementUpdate, $paramUpdate, "Redefinição de senha");
            $mail = new PHPMailer(true);
            try {
                $mail->IsSMTP();
                $mail->SMTPSecure = 'tls'; 
                $mail->SMTPAuth = true;
                $mail->Host = "ssl://smtp.gmail.com";
                $mail->Port = 465;
                $mail->Username = "naoresponda.iserj@gmail.com";
                $mail->Password = "boletimPFISERJMG";

                $mail->setFrom('naoresponda.iserj@gmail.com');
                $mail->addAddress($row["emailConta"]);

                $mail->isHTML(true);
                $mail->Subject = 'Senha redefinida com sucesso.';
                $mail->Body = <<<HTML
                    <p>
                        Sua senha foi redefinida para o site Boletim ISERJ.   
                    </p>
                HTML;
                if (!$mail->Send()) {
                    //debug
                }
                else {
                    //debug
                }
            }
            catch (Exception $e) {
                //debug
            }
        }
        elseif ($valido > 180) {
            $statementDelete = "
                DELETE FROM redefinirSenha
                WHERE
                    chave = ?
                ";
            $paramDelete = array("s", $chave);
            Query::execute($statementDelete, $paramDelete);
        }
    }
}
header("Location: /login");
exit();
?>