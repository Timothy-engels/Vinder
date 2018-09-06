<?php
//business/accountService.php

require_once("data/accountDAO.php");

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

    public function resetPass($email){
        $accountsDAO = new AccountDAO();
        $account = $accountsDAO->getByEmail($email);
        // the message
        $code = password_hash($account->getPassword().$email,PASSWORD_BCRYPT);
        $msg = "Hallo, click op de link om password te reseten : http://core.band/vinder/resetPassword.php?email=".$email."&hash=".$code;
        echo "Verstuurd bericht (alleen om te testen): ".$msg;
        // send email
        mail($email,"Vinder account activeren",$msg);
    }
}

