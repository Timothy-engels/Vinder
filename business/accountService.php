<?php
//business/accountService.php

require_once("data/accountDAO.php");
require_once("business/mailService.php");
require_once("business/encryptionService.php");

class AccountService
{
    /**
     * Get an array with all accounts
     * 
     * @return array
     */
    public function getAccounts()
    {
        $accountsDAO = new AccountDAO();
        $list        = $accountsDAO->getAll();
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
     * Update the account
     * 
     * @param obj $account (type : Account)
     * 
     * @return bool
     */
    public function update($account)
    {
        $accountDAO = new AccountDAO();
        $updated    = $accountDAO->update($account);
        
        return $updated;
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
        $encryptionSvc = new EncryptionService();
        $code          = $encryptionSvc->encryptString(
            $confirmationString,
            $encryptionSvc::CONFIRM_REGISTRATION_KEY
        );

        // Generate the message
        $currentPath = $this->getCurrentPath();
        $link        = $currentPath . "confirmRegistration.php?code=" . $code;
        
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
     * Get the current path (without filename)
     * 
     * @return string
     */
    public function getCurrentPath()
    {
        $result = '';
        
        $protocol   = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $currentUrl = $protocol . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        
        // Remove the extra parameters
        $position = strrpos($currentUrl, '?');
        
        if ($position !== false) {
            $currentUrl = substr($currentUrl, 0, $position);
        }
        
        // Remove the file name
        $position   = strrpos($currentUrl, '/', -0);    
        
        if ($position !== false) {
            $currentUrl = substr($currentUrl, 0, $position + 1);
        }
        
        return $currentUrl;
    }
    
    /**
     * Get the information of the logged in user
     * When no user is logged in, the function redirects to the login page
     * 
     * @param bool $checkedInAsAdmin (Should the user be an administrator?)
     * 
     * @return obj (type: Account)
     */
    public function getLoggedInUser($checkedInAsAdmin = false)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!array_key_exists('ID', $_SESSION)) {
            header("location: logIn.php");
        }
        
        $account = $this->getById($_SESSION['ID']);
        
        if ($account === null) {
            header("location: logIn.php");
        }
        
        if ($checkedInAsAdmin === true) {
            if ($account->getAdministrator() === "0") {
                header("location: logIn.php");
            }
        }
        
        return $account;
    }
}
