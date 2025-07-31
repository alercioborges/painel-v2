<?php

namespace app\src;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use app\src\Load;

class Email
{
    public function send(array $emailData)
    {
        $mail = new PHPMailer(true);
        $config = Load::file('/app/config/SMPT.php');
        
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();

            $mail->Host = $config['host'];
            $mail->SMTPAuth = true;
            $mail->Mailer  = 'smpt'; 
            $mail->Username = $config['username'];
            $mail->Password = $config['password'];
            $mail->SMTPSecure = $config['secure']; //PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $config['port'];
            $mail->CharSet = 'UTF-8';

            //Recipients
            $mail->setFrom($config['username'], 'Alercio');
            $mail->addAddress($emailData['email'], 'Alercio');

            $mail->isHTML(true);
            $mail->Subject = $emailData['subject'];
            $mail->Body    = $emailData['message'];
            $mail->AltBody = 'Rodapé';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
