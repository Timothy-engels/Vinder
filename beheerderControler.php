<?php

require_once 'business/accountService.php';

session_start();

$_Session["admin"] = true;

if ($_Session["admin"] == false){
    header('location: login.php');
}
else{
    
    $accountSvc = new AccountService();
    $lijst      = $accountSvc->getAccounts();
    
    include 'presentation/lijstGebruikers.php';
}
