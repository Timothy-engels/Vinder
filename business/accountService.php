<?php
//business/accountService.php

require_once("data/accountDAO.php");
require_once("business/mailService.php");

class AccountService
{
    const CONFIRM_REGISTRATION_KEY = 'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS';

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
     * Find an account by id
     *
     * @param int $id
     *
     * @return Account|null
     */
    public function getById($id)
    {
        $accountDAO = new AccountDAO();
        $account    = $accountDAO->getById($id);
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
    
    /**
     * Update the password
     * 
     * @param int $accountId
     * @param string $password
     * 
     * @return string
     */
    public function updatePassword($accountId, $password)
    {
        $accountDAO = new AccountDAO();
        $accountDAO->updatePassword($accountId, $password);
    }

    public function confirmAccount($email){
        $confirmDAO = new AccountDAO();
        $confrim = $confirmDAO->confirm($email);
        return $confrim;
    }

    /**
     * Send an email to confirm the registration
     * 
     * @param object $account
     * 
     * @return void
     */
    public function sendConfirmRegistrationMail($account)
    {
        $id    = $account->getId();
        $email = $account->getEmail();
        
        // Get the confirmation string
        $confirmationString  = $id . "|" . $email;
        
        // Get the encryption key
        $code = $this->encryptString($confirmationString, self::CONFIRMATION_KEY);

        // Generate the message
        $link = "http://core.band/vinder/confirmEmail.php?code=" . $code;
        
        $msg = "
            <p>Beste,<br/><br/>
            Klik op de onderstaande link om je registratie te bevestigen:<br />
            <a href=\"" . $link . "\">Bevestigen</a><br /><br />
            Met vriendelijke groeten,<br/>
            VDAB</p>
        ";
        
        // Send html email        
        $mailSvc = new MailService();
        $mailSvc->sendHtmlMail($email, "Vinder | Registratie bevestigen", $msg);
    }
    
    /**
     * Encrypt a string
     * 
     * @param string $string
     * @param string $key
     * 
     * @return string
     */
    private function encryptString($string, $key)
    {
        $cipher = "aes-128-gcm";
        $ivlen  = openssl_cipher_iv_length($cipher);
        $iv     = openssl_random_pseudo_bytes($ivlen);
        $tag    =  "GCM";

        return openssl_encrypt(
            $string,
            $cipher,
            $key,
            $options = 0,
            $iv,
            $tag
        );
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
                if($admin === 1) {
                    $_SESSION["admin"] = TRUE;
                    $_SESSION["ID"] = $id;
                    print($admin);
                    //header("location: admin.php");
                }
                else {
                    $_SESSION["ID"] = $id;
                    header("location: ingelogd.php");
                }
            }
            else {
               header("location: logIn.php");
            }
        }
        else {
            header("location:logIn.php");
        }
    }
    
    public function logOut() {
    	$_POST["logOut"] = NULL;
		session_destroy();
		//header("location: ../presentation/logInForm.php");
	}
    
    /**
     * Returns to the login page when the user isn't logged in
     * 
     * @return void
     */
    public function checkUserLoggedIn($admin = false)
    {
        session_start();
        
        if (!array_key_exists('ID', $_SESSION)) {
            header("location: logIn.php");
        }
        
        if ($admin === true) {
            if (
                !array_key_exists('admin', $_SESSION)
                || $_SESSION['admin'] === false
            ) {
                header("location: logIn.php");
            }
        }
    }
    
    /**
     * Return the ID of the logged in user
     * (If no user is logged in -> redirect to the login page)
     * 
     * @return int
     */
    public function getLoggedInAccountId()
    {
        $this->checkUserLoggedIn();
        return $_SESSION['ID'];
    }
    
}
