<?php

    session_start();

    require_once("LogIn.php");
        
    if (isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
    }
    else if(isset($_POST["mail"]) && isset($_POST["pass"])) {
        $mail = $_POST["mail"];
        $pass = $_POST["pass"];
        $logIn = new Validation;
        $id = $logIn->validate($mail, $pass);
        print($id);
        if ($id != NULL) {
            $_SESSION["ID"] = $id;
            header("location: end.php");
        }
        else {
            header("location: logInForm.php");
        }
    }
        
        
            //$profile = new Profile;
            //$profile->functionName($id);
