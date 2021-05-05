<?php

    class validateContactForm{
        

        // VALIDATING THE TEXTFIELD
        function validateName($name){
            if (empty($name) || filter_var(!$name, FILTER_SANITIZE_STRING) || !preg_match('/[a-zA-Z\s]+$/', $name) || $name == 'null' || $name == 'undefined' || $name == ''){
                echo '<script> alert("Please Enter a Valid name! Ex: John Smith")</script>';
                return "Please Enter Your Name";
            }else{
                return "";
            }
        }

        // Validating the Email
        function validateEmail($email){
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) ){
                echo '<script> alert("Please Enter a Valid Email! Ex: user@email.com")</script>';
                return "enter email";
            }else{
                return "";
            }
        }

        function validateMessage($message){
            if (empty($message) || filter_var(!$message, FILTER_SANITIZE_STRING) || !preg_match('/[a-zA-Z\s]+$/', $message) || $message == 'null' || $message == 'undefined' || $message == ''){
                echo '<script> alert("Please Enter a Valid Message! Ex: Hello, I am...")</script>';
                return "enter message";
            }else{
                return "";
            }
        }

    }

?>