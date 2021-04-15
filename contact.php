<?php

require_once('contact.class.php');

// set values to nothing to avoid conflicts
$name = "";
$email = "";
$message = "";

// error messages
$nameErrMsg = "";
$emailErrMsg = "";
$messageErrMsg = "";

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $validContactForm = new validateContactForm();

    //$validContactForm->getDataFromForm();
    $validContactForm->validateFirstName($fName);
    $validContactForm->validateLastName($email);
    $validContactForm->validateMessage($message);
    //$validContactForm->saveData();

    if($validContactForm == ""){
        $validContactForm->saveData();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="css/contact.css" rel="stylesheet" type="text/css">
    <title>Contact</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">

    <a class="navbar-brand col-9 ml-3" href="index.html"><span class="navWhiteHead">Murphy Cemetery</span></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mr-2" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item pr-2">
                <a class="nav-link" href="index.html"><span class="navWhite">Home</span></a>
            </li>
            <li class="nav-item pr-2">
                <a class="nav-link" href="about.html"><span class="navWhite">About</span></a>
            </li>
            <li class="nav-item active pr-2">
                <a class="nav-link" href="contact.php"><span class="navWhite">Contact</span></a>
            </li>
            <li class="nav-item pr-2">
                <a class="nav-link" href="#"><span class="navWhite">Search</span></a>
            </li>
        </ul>
    </div>
    </nav>

    <div class="container col-10">

        <main>
            <img src="images/contact.jpg" alt="murphy cemetery entrance">
        </main>
        
        <aside>
            <h1>Contact Us</h1>

            <form method="POST" action="#">

                <div class="form-group col-10 m-auto">
                    <label for="name">Name:</label>
                    <input type="name" class="form-control" id="name" placeholder="Enter your name here"><span><?php echo $nameErrMsg; ?></span>
                </div>

                <div class="form-group col-10 m-auto">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email"><span><?php echo $emailErrMsg; ?></span>
                </div>

                <div class="form-group col-10 m-auto">
                    <label for="message">Message: </label>
                    <textarea class="form-control" name="message" id="message" placeholder="Enter message here"></textarea><span><?php echo $messageErrMsg; ?></span>
                </div>
            
                <div class="buttons"> 
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn">Reset</button>
                </div>

            </form>
        </aside>

        <aside class="map">
            <center>
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11849.51165807224!2d-93.3673001!3d42.0565183!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x98f0bf25c99a4095!2sMurphy%20Cemetery!5e0!3m2!1sen!2sus!4v1617830636912!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </center>
        </aside>

    </div>
    
    <footer>
        <div class="row">
            <div class="col-4">
                <a href="login.php" target="_blank">Login</a>
            </div>
            <div class="col-4">
                <center>
                    <p>&copy; Copywrite Murphy Cemetery <script> new Date().getFullYear()</script></p>
                </center>
            </div>
            <div class="col-4">
                <center>
                    <p>Nevada, IA 50201</p>
                </center>
            </div>
        </div>
    </footer>
</body>
</html>