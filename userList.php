<?php

require_once 'business/accountService.php';

// Check if a admin is logged in
$accountSvc = new AccountService();
$account = $loggedInAccount = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get a list with all the accounts
$list = $accountSvc->getAccounts();

// Show the view
include 'presentation/userList.php';
