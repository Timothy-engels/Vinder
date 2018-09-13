<?php
//business/accountService.php

require_once("data/accountDAO.php");
require_once("business/mailService.php");

class AccountService
{
    const CONFIRM_REGISTRATION_KEY = 'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS';
    const FORGOTTEN_PASSWORD_KEY   = 'MxSxqv4NKjb4rwjfh7SzrYNV5uGEg45H';
    const CIPHER                   = 'aes-256-cbc';

    

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

    /**
     * Confirm the registration of an account
     * 
     * @param int $accountId
     * 
     * @return bool
     */
    public function confirmRegistration($accountId)
    {
        $confirmDAO = new AccountDAO();
        $confirm    = $confirmDAO->confirmRegistration($accountId);
        return $confirm;
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
        $code = $this->encryptString($confirmationString, self::CONFIRM_REGISTRATION_KEY);

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
     * Encrypt a string
     * 
     * @param string $string
     * @param string $key
     * 
     * @return string
     */
    public function encryptString($string, $key)
    {
        $ivlen  = openssl_cipher_iv_length(self::CIPHER);
        $iv     = openssl_random_pseudo_bytes($ivlen);
        
        $encrypted = openssl_encrypt(
            $string,
            self::CIPHER,
            $key,
            $options = 0,
            $iv
        );

        return base64_encode($encrypted . '::' . $iv);
    }
    
    /**
     * Decrypt a string
     * 
     * @param string $string
     * @param string $key
     * 
     * @return type
     */
    public function decryptString($string, $key)
    {
        $result        = '';
        $base64Decoded = base64_decode($string);
        $position      = strrpos($base64Decoded, '::');
        
        if ($position !== false) {
            list($encrypted_data, $iv) = explode('::', base64_decode($string), 2);

            $result = openssl_decrypt(
                $encrypted_data,
                self::CIPHER,
                $key,
                $options = 0,
                $iv
            );  
        }
        
        return $result;
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
     * Returns to the login page when the user isn't logged in
     * 
     * @return void
     */
    public function checkUserLoggedIn($admin = false)
    {        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
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
    
    /**
     * Check if the user is logged in as an admin
     * 
     * @return boolean
     */
    public function isLoggedInAsAdmin()
    {
        $result = false;
        
        if (array_key_exists('admin', $_SESSION)) {
            if ($_SESSION['admin'] === true) {
                $result = true;
            }
        }
        
        return $result;
    }
    
}
