<?php

require_once('../inc/contact.class.php');
$validContactForm = new validateContactForm();

// set values to nothing to avoid conflicts
$name = "";
$fromEmail = "";
$message = "";

// error messages
$nameErrMsg = "";
$emailErrMsg = "";
$messageErrMsg = "";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $fromEmail = $_POST['email'];
    $message = $_POST['message'];

    //$validContactForm->getDataFromForm();
    $validName = $validContactForm->validateName($name);
    $validEmail = $validContactForm->validateEmail($fromEmail);
    $validMessage = $validContactForm->validateMessage($message);
    //$validContactForm->saveData();

   // var_dump($validName);die;

    if($validName == "" && $validEmail == "" && $validMessage == ""){
        $mailTo = 'contact@davidhuck.net';
            $headers = "From: " . $fromEmail;
            $txt = "You have a new email from " . $name . ".\n\n" . $message;
            echo '<script> alert("Email Sent!")</script>';
            mail($mailTo, $txt, $message, $headers);
            header('Location: contactConfirmation.php');
            exit;
    }

}

require_once('../tpl/contact.tpl.php');

?>

