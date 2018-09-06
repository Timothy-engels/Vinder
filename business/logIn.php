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
/*
    else if(isset($_POST["mail"]) && isset($_POST["reset"])) {
		$mail = $_POST["mail"];
        $_POST["mail"] = NULL;
		$_POST["reset"] = NULL;
		$accDAO = new AccountDAO;
        $account = $accDAO->getByEmail($mail);
		if($contactName != NULL) {
			$message = "Beste , er is een aanvraag gebeurd om het wachtwoord van uv Vinder-account te wijzigen, klik <a>hier</a> om een nieuw wachtwoord aan te maken.<br>
			            Indien u deze aanvraag niet hebt gedaan, gelieve deze mail dan te negeren.<br>
						Met vriendelijke groeten, het Vinder-team.";
			$subject = "Vinder wachtwoord wijzigen";
			mail($mail, $subject, $message);
			header("location: ../logIn/gelukt.php");
		}
		else {
			header("location: notRealURL.php");
		}
	}*/
    