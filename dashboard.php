<?php

require_once("business/accountService.php");

$accountSvc = new AccountService();
$accountSvc->checkUserLoggedIn();

$accountId = $accountSvc->getLoggedInAccountId();
$account   = $accountSvc->getById($accountId);

if ($account !== null) {
    
    $info = $account->getInfo();
    
    if ($info === null || $info == "") {
        header("location: editProfile.php");
    } else {
        header("location: showProfile.php");
    }
    
} else {
    header("location: logIn.php");
}