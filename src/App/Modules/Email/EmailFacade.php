<?php

namespace App\Modules\Email;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class EmailFacade
{
    public function __construct()
    {
    }

    public function send(Email $email)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASSWORD;
            $mail->Port       = EMAIL_PORT;

            $mail->setFrom($email->getFromEmail(), $email->getFromName());
            $mail->addAddress($email->getToEmail());     
            $mail->addReplyTo($email->getReplyToEmail(), $email->getReplyToName());

            $mail->isHTML(true);                                  
            $mail->Subject = $email->getSubject();
            $mail->Body    = $email->getContent();
            $mail->AltBody = strip_tags($email->getContent());

            $mail->send();
        } catch (Exception $e) {
            // @TODO: Logging service
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
