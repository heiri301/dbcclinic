<?php
    use PHPMailer\PHPMailer\PHPMailer;
    include "..\addons\phpmailer\PHPMailer.php";
    include '..\addons\phpmailer\SMTP.php';
    include '..\addons\phpmailer\Exception.php';

    class Mailer{
       function sendMail($db){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $body = $_POST['body'];

            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = 'sample@email.com';
            $mail->Password = '';
            $mail->Port = 465; //587 (TLS)
            $mail->SMTPSecure = "ssl";

            $mail->isHTML(true);
            $mail->setFrom($email,$name);
            $mail->addAddress( ); //input email address
            $mail->Subject = $subject;
            $mail->Body = $body;

       }
    }
?>