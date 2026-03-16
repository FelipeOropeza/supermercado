<?php

declare(strict_types=1);

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private string $host;
    private int $port;
    private string $username;
    private string $password;
    private string $fromEmail;
    private string $fromName;

    public function __construct()
    {
        $this->host = $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com';
        $this->port = (int)($_ENV['MAIL_PORT'] ?? 587);
        $this->username = $_ENV['MAIL_USERNAME'] ?? '';
        $this->password = $_ENV['MAIL_PASSWORD'] ?? '';
        $this->fromEmail = $_ENV['MAIL_FROM_ADDRESS'] ?? 'no-reply@supermercado.com';
        $this->fromName = $_ENV['MAIL_FROM_NAME'] ?? 'Supermercado Online';
    }

    public function send(string $to, string $subject, string $body, bool $isHtml = true): bool
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = $this->host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $this->port;
            $mail->CharSet    = 'UTF-8';

            // Recipients
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addAddress($to);

            // Content
            $mail->isHTML($isHtml);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Erro ao enviar e-mail: {$mail->ErrorInfo}");
            return false;
        }
    }
}
