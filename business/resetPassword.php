<?php
 
    session_start();

    require_once("../data/accountDAO.php");
    require_once("accountService.php");

    if (isset($_SESSION["ID"])) {
        header("location: ../logIn/end.php");
    }

    else if(isset($_POST["mail"]) && isset($_POST["reset"])) {
		$mail = $_POST["mail"];
        $_POST["mail"] = NULL;
		$_POST["reset"] = NULL;
		$accDAO = new AccountDAO();
        $account = $accDAO->getByEmail($mail);
		if($account != NULL) {
            $contactName = $account->getContactPerson();
            $pass = $account->getPassword();
            $resetMail = new AccountService();
			$resetMail->sendResetEmail($mail, $contactName, $pass);
			//header("location: ../logIn/gelukt.php");
		}
		else {
			header("location: onbekendeMail.php");
		}
	}