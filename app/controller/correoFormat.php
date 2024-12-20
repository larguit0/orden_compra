<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require __DIR__ . '/../../vendor/autoload.php';

function enviarCorreo($correo, $nombre) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.hostinger.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'ordenCompra@erp-acema.com';            //SMTP username
        $mail->Password   = 'Acema2024*';                           //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('ordenCompra@erp-acema.com', 'Acema:Orden Compra');
        $mail->addAddress($correo, $nombre); // Add recipient dynamically

        //Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'TIENE UNA APROBACION';
        $mail->Body = '<p><strong><a href="https://erp-acema.com/orden_compra/" style="text-decoration:none; color:blue;">Tiene una orden pendiente por inspeccionar (click para inspeccionar)</a></strong></p>';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
