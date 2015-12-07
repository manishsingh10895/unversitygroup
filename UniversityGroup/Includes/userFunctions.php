<?php
$root = $_SERVER['DOCUMENT_ROOT']."/newForum";
require $root.'/PHPMailer-master/PHPMailerAutoload.php';

 function SendPasswordChangeMail($email,$id)
 {
     echo "In Email Sender";
     $mail = new PHPMailer;
     $mail->isSMTP();
     $mail->SMTPDebug = 2;
     $mail->Debugoutput = 'html';
     $mail->Host = 'smtp.gmail.com';
     $mail->Port = 587;
     $mail->SMTPSecure = 'tls';
     $mail->SMTPAuth = true;
     $mail->Username = 'manishsingh10895@gmail.com';
     $mail->Password = "Term!nator";
     $mail->addAddress($email);
     $mail->Subject= 'Password Change Request';
     $emailText = <<< email
Dear user,
Click on the followind link to reset your password  : 
http://{$_SERVER['REMOTE_ADDR']}/newForum/user-content/resetPassword.php?uid={$id};

Notice : This link will get expired in 24 hours, please change your password before that.

Thanks,
Admin
Thy Forum 
email;

     $mail->Body = $emailText;

     if (!$mail->send()) {
         echo $mail->ErrorInfo;
         return false;
     } else {
         echo "email send";
         return true;
     }
 }
?>