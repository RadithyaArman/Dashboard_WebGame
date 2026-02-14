<?php
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
  public function sendMail($to, $subject, $body)
  {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'andiradithya0711@gmail.com';
    $mail->Password = 'rogu untt pkzp djqx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('andiradithya0711@gmail.com', 'Laravel App');

    foreach ((array)$to as $email ) {
      $mail->addAddress($email);
    }

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();
  }
}
