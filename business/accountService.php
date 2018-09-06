<?php
//business/accountService.php

require_once("../data/accountDAO.php");

class AccountService
{
    public function getAccounts()
    {
        $accountsDAO = new AccountDAO();
        $list = $accountsDAO->getAll();
        return $list;
    }
    
    /**
     * Find an account by email address
     * 
     * @param string $email
     * 
     * @return Account|null
     */
    public function getByEmail($email)
    {
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->getByEmail($email);
        return $account;
    }
    
    /**
     * Insert a new account
     * 
     * @param string $name
     * @param string $contactPerson
     * @param string $email
     * @param string $password
     * 
     * @return Account
     */
    public function insert($name, $contactPerson, $email, $password)
    {        
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->insert($name, $contactPerson, $email, $password);
        return $account;
    }

    public function confirmAccount($email){
        $confirmDAO = new AccountDAO();
        $confrim = $confirmDAO->confirm($email);
        return $confrim;
    }

    public function sendEmail($email){
        // the message

        $code = password_hash($email.'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS',PASSWORD_BCRYPT);
        $msg = "Hallo, click op de link om het account te activeren: http://core.band/vinder/confirmEmail.php?email=".$email."&hash=".$code;
        echo "Verstuurd bericht (alleen om te testen): ".$msg;
        // send email
        mail($email,"Vinder account activeren",$msg);
    }

    public function sendResetEmail($mail, $contactName, $pass) {
        $url = $mail . $pass;
        $url = password_hash($url, PASSWORD_DEFAULT);
        $msg = "<html><head><title>Wachtwoord Resetten</title></head>           <body>Beste " . $contactName . ", er is een aanvraag gebeurd om het wachtwoord van uw Vinder-account te wijzigen, klik <a href='http://www.vinder.be/resetPassword?" . $url . "'>hier</a> om een nieuw wachtwoord aan te maken.<br>
		Indien u deze aanvraag niet hebt gedaan, gelieve deze mail dan te negeren.<br>
        Met vriendelijke groeten, het Vinder-team.
        </body></html>";
        $subject = "Vinder account activeren";
        mail($mail, $subject, $msg);
    }
    
    public function logIn($mail, $pass) {
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
                    header("location: ../presentation/end.php");
                }
            }
            else {
               header("location: ../presentation/logInForm.php");
            }
        }
        else {
            header("location: ../presentation/logInForm.php");
        }
    }
    
    public function logOut() {
    	$_POST["logOut"] = NULL;
		session_destroy();
		header("location: ../presentation/logInForm.php");
	}
}

