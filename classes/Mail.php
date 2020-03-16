<?php

//date_default_timezone_set('Etc/UTC');
use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

    class Mails {
        public static function sendEmail($cust_email, $subject, $mailContent, $path) {
            $mail = new PHPMailer();
            $mail->isSendmail(); // disable SMTP for local host testing
            // $mail->isSMTP(); // Enable SMTP for gmail
            $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.mailtrap.io";
            $mail->Port = 2525; // or 587
            $mail->Username = "c38ef316bb66f3";
            $mail->Password = "8da63812c1d7e5";
            $mail->SetFrom('info@mailtrap.io', 'YouConnect');
            $mail->addReplyTo('info@mailtrap.io', 'YouConnect');
            $mail->AddAddress($cust_email);
            $mail->Subject = $subject;
            $mail->addEmbeddedImage($path, 'Ticket_image');
            $mail->IsHTML(true);

            $mail->Body = $mailContent;

            if($mail->send()){
                // echo 'Message has been sent. Is a goal!';
            }else{
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        }

    }