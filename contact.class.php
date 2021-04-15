<?php

    // VALIDATING THE TEXTFIELD
    function validateName($name){
        if (empty($name) || filter_var(!$name, FILTER_SANITIZE_STRING) || !preg_match('/[a-zA-Z\s]+$/', $name) || $name == 'null' || $name == 'undefined' || $name == ''){
            echo '<script> alert("Please Enter a Valid First Name! Ex: John")</script>';
        }
        return "";
    }

    // Validating the Email
    function validateEmail($email){
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ){
            echo '<script> alert("Please Enter a Valid Email! Ex: user@email.com")</script>';
        }
        return "";
    }

    function validateMessage($message){
        if (empty($message) || filter_var(!$message, FILTER_SANITIZE_STRING) || !preg_match('/[a-zA-Z\s]+$/', $message) || $message == 'null' || $message == 'undefined' || $message == ''){
            echo '<script> alert("Please Enter a Valid Message! Ex: Hello, I am...")</script>';
        }
        return "";
    }

    function saveData(){
                    
        $mailTo = 'contact@davidhuck.net';
        $headers = "From: " . $email;
        $txt = "You have recieved an email from " . $name . "\n\n" . "Email: " . $email . "\n\n" . "Message:" .  $message;

        mail($mailTo, $message, $txt, $headers);
        echo "Email Sent!";
        header('Location: contact.php');
        exit;
    }

?>