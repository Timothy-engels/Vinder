<?php

    session_start();

    require_once("business/accountService.php");

    if (isset($_SESSION["ID"])) {
        include("presentation/end.php");
    }
    else if(isset($_POST["mail"]) && isset($_POST["pass"])) {
        $mail = $_POST["mail"];
        $_POST["mail"] = NULL;
        $pass = $_POST["pass"];
        $_POST["pass"] = NULL;
        $log = new AccountService();
        $log->logIn($mail, $pass);
        
    }
    else {
        include("presentation/logInForm.php");
    }