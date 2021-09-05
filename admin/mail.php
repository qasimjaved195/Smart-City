<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendmail($sendTo, $msubject, $mbody){
    $developmentMode = true;
$mailer = new PHPMailer($developmentMode);

try{
    $mailer->SMTPDebug = 2;
    $mailer->isSMTP();
    if($developmentMode)
    {
        $mailer->SMTPOptions = [
        'ssl'=>[
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        ]
        ];
    }
    $mailer->Host = 'smtp.gmail.com';
    $mailer->SMTPAuth = true;
    $mailer->Username = 'Enter Your gmail id';
    $mailer->Password = 'Enter Your password ';
    $mailer->SMTPSecure = 'tls';
    $mailer->Port = '587';

    $mailer->setFrom('mehran.shabir711@gmail.com','mehran');
    $mailer->addAddress($sendTo);
    $mailer->isHTML(true);
    $mailer->Subject = $msubject;
    $mailer->Body =$mbody;

    $mailer->send();
    $mailer->ClearAllRecipients();
    // header('location: profile.php');
    }
    catch (Exception $e){
        // $_SESSION['message']="Registration failed";
        //     header('location: error.php');
    }
}
