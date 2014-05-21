<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 21/05/2014
 * Time: 13:47
 */

require_once("vendor/autoload.php");

echo $_POST['name'] . $_POST['email'] . $_POST['content'];

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$content = nl2br(trim($_POST['content']));

if (strlen($name) && strlen($email) && strlen($content))
{
    if (false !== filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $mail = new PHPMailer();
        $mail->From = $email;
        $mail->FromName = $name;
        $mail->addAddress("mathieu.savy@gmail.com", "Mathieu Savy");
        $mail->addReplyTo($email, $name);

        $mail->Subject = "Contact from mathieu-savy.com";
        $mail->isHTML(true);
        $mail->Body = $content;

        if($mail->send())
            echo '1';
        else
            echo $mail->ErrorInfo;
    }
    else
        echo '2';
}
else
    echo '3';