<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function email($mailTo, $subject, $message, $mailFrom, $mailName)
    {
        // require APPPATH.'libraries/vendor/autoload.php';
        require APPPATH.'libraries/PHPMailer-master/src/Exception.php';
        require APPPATH.'libraries/PHPMailer-master/src/PHPMailer.php';
        require APPPATH.'libraries/PHPMailer-master/src/SMTP.php';

        $mail = new PHPMailer();

        $mail->IsSMTP();

        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host = 'mail.dripsweet.com';
        $mail->Port = 465;
        $mail->Username = 'admin@dripsweet.com';
        $mail->Password = 'dripsweet1234';

        $mail->AddAddress($mailTo);
        $mail->SetFrom($mailFrom, $mailName);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->Send()) {
            return 'Terkirim';
        }else{
            return 'Tidak Terkirim';
        }

        
    }
}