<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;

class MailerService
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $encryption;
    private string $from;
    private string $fromName;
    private string $to;
    private string $toName;
    private string $subject;
    private string $body;
    private string $altBody;
    private string $template;
    private array $data;

    public function __construct()
    {
        $this->host = env('MAIL_HOST', 'smtp.mailtrap.io');
        $this->fromName = "Notification System";
        $this->port = env('MAIL_PORT', 2525);
        $this->username = env('MAIL_USERNAME', 'username');
        $this->password = env('MAIL_PASSWORD', 'password');
        $this->encryption = env('MAIL_ENCRYPTION', 'tls');
        $this->from = env('MAIL_FROM', '');
    }

    public function subject(string $subject): static
    {
        $this->subject = $subject;
        return $this;
    }

    public function body(string $message): static
    {
        $this->body = $message;
    }

    public function text(string $message): static
    {
        $this->altBody = $message;
    }

    public function to(string $email, string $name = null): static
    {
        $this->to = $email;
        $this->toName = $name;
    }

    public function template(string $template, array $data = []): static
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function send()
    {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = $this->host;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $this->username;                     //SMTP username
            $mail->Password   = $this->password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = $this->port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('from@example.com', 'Mailer');
            $mail->addAddress($this->to);     //Add a recipient//Name is optional

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = $this->altBody;

            $mail->send();

        } catch (\Exception $e) {
            print $e->getMessage();
        }
    }
}