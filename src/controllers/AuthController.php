<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php'; //FIJATE EN LA RUTA DEL VENDOR


class AuthController
{

    public function sendOtp($email)
    {

        $otp = rand(100000, 999999);

        $mail = new PHPMailer(true);

        try {

            /*
            MAIL_MAILER=smtp 
    MAIL_HOST=smtp.gmail.com 
    MAIL_PORT=587 
    MAIL_USERNAME=alexkiller0408@gmail.com
    MAIL_PASSWORD=vmuaytcgujbpyrio
    MAIL_ENCRYPTION=tls 
    MAIL_FROM_ADDRESS=miapi@gmail.com 
    MAIL_FROM_NAME="API Laravel"
             */

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'alexkiller0408@gmail.com';
            $mail->Password = 'vmuaytcgujbpyrio';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('alexkiller0408@gmail.com', 'otp con imagen');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'el tema bro';
            $mail->addEmbeddedImage(
                __DIR__ . '/../../src/images/cisma.png',
                'la_reforma'
            );

            //el cid: es obligatorio para que se muestre la imagen


            $mail->Body = "
          
            <div style='font-family: Arial; padding:20px;'>
                   <img src='cid:la_reforma' width='520' height='300' />
                   
                    <p>Tu codigo de verificacion es:</p>
                    <h1 style='letter-spacing:5px;'>$otp</h1>
                    <p>Este codigo expira en 5 minutos.</p>
                </div>
       
                
            ";

            $mail->send();

            return [
                "message" => "OTP enviado correctamente",
                "otp" => $otp // solo para pruebas, luego se elimina
            ];

        } catch (Exception $e) {
            return ["error" => $mail->ErrorInfo];
        }
    }
}
