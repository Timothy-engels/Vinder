<?php

    session_start();

    require_once("../data/accountDAO.php");
        
    if (isset($_SESSION["ID"])) {
        header("location: ../logIn/end.php");
    }
    else if(isset($_POST["mail"]) && isset($_POST["pass"])) {
        $mail = $_POST["mail"];
        $_POST["mail"] = NULL;
        $pass = $_POST["pass"];
        $_POST["pass"] = NULL;
        $accDAO = new AccountDAO;
        $account = $accDAO->getByEmail($mail);
        if ($account !== NULL) {
            $id = $account->getId();
            $hash = $account->getPassword();
            $admin = $account->getAdministrator();
            if(password_verify($pass, $hash)) {
                if($admin == 1) {
                    $_SESSION["admin"] = TRUE;
                    $_SESSION["ID"] = $id;
                    header("location: admin.php");
                }
                else {
                    $_SESSION["ID"] = $id;
				    $_POST["process"] = NULL;
                    header("location: ../presentation/end.php");
                }
            }
            else {
;               header("location: ../presentation/logInForm.php");
            }
        }
        else {
;            header("location: ../presentation/logInForm.php");
        }
    }