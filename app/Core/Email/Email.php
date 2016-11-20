<?php
namespace App\Core\Email;

use App\Core\Email\PHPMailer\PHPMailer;

class Email {

    public function enviaEmail($usuario) {

        $mail = new PHPMailer();
        $mail->setLanguage("pt");

        //conf servidor
        $host = 'smtp.live.com';
        $username = 'auditores.login@hotmail.com';
        $password = 'Nvidia1234';
        $port = 587;
        $secure = 'tls';
        //remetente
        $from = $username;
        $fromName = "Contre de Segurança";

        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->Port = $port;
        $mail->SMTPSecure = $secure;
        $mail->From = $from;
        $mail->FromName = $fromName;
        //destinataio
        $mail->addAddress('auditores.login@hotmail.com', $usuario);
        $mail->isHTML(true);
        $mail->CharSet = 'utf-8';
        $mail->WordWrap = 70;
        $mail->Subject = 'Tentativas de login expiradas';
        $mail->Body = 'O usuário <b> ' . $usuario . ' </b>tentou acessar o email mais de
                          três vezes sem sucesso. Verifique possíveis tentativas de
                          acesso indevido';
        $mail->AltBody = 'O usuário ' . $usuario . ' tentou acessar o email mais de
                          três vezes sem sucesso. Verifique possíveis tentativas de
                          acesso indevido';

        return $mail->Send();
    }

}
