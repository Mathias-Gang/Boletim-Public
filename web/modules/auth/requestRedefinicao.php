<?php
require_once("../database/conexao.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require("../../vendor/autoload.php");

$recaptcha = JSON_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfUsfMcAAAAANe2Y_8dfPvaVm0w_BITfU9m3XNP&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']));
if ($_SERVER["REQUEST_METHOD"] === "POST" and $recaptcha->success) {
    $email = $_POST["email"];
    $statementConta = "
        SELECT 
            email
        FROM conta
        WHERE 
            email = ?
    ";
    $paramConta = array("s", $email);
    $queryConta = Query::execute($statementConta, $paramConta);
    if ($queryConta->num_rows == 1) {
        while (true) {
            $chave = bin2hex(random_bytes(24));
            $statementExists = "
                SELECT
                    chave
                FROM redefinirSenha
                WHERE
                    chave = ?
                ";
            $paramExists = array("s", $chave);
            $queryExists = Query::execute($statementExists, $paramExists);
            if (!$queryExists->num_rows == 1) {
                $statementRedefinir = "
                    INSERT INTO redefinirSenha
                        (emailConta, chave, validade)
                    VALUES
                        (?, ?, UTC_TIMESTAMP())
                    ";
                $paramRedefinir = array("ss", $email, $chave);
                Query::execute($statementRedefinir, $paramRedefinir);
                break;
            }
        }
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
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Redefinir senha';
            $mail->Body = <<<HTML
                <a href={$_SERVER['SERVER_NAME']}/redefinir?q={$chave}>
                    Redefinir senha
                </a><br>
                <p>
                    para {$email} no Boletim ISERJ
                </p>
            HTML;
            if(!$mail->Send()) {
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
}
header("Location: /");
exit();
?>