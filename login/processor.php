<?php

    session_start();

    require_once("LogIn.php");
        
    if (isset($_SESSION["ID"])) {
        header("location: end.php");
    }
    else if(isset($_POST["mail"]) && isset($_POST["pass"])) {
        $mail = $_POST["mail"];
        $_POST["mail"] = NULL;
        $pass = $_POST["pass"];
        $_POST["pass"] = NULL;
        $id = new Validation;
        $id = $id->getId($mail);
        if ($id != NULL) {
            $hash = new Validation;
            $hash = $hash->getPassword($id);
            if(password_verify($pass, $hash)) {
                $_SESSION["ID"] = $id;
                header("location: end.php");
            }
            else {
;               header("location: logInForm.php");
            }
        }
        else {
;            header("location: logInForm.php");
        }
    }
        
        
            //$profile = new Profile;
            //$profile->functionName($id);
