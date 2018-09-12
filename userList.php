<?php

require_once 'business/accountService.php';

// Check if a admin is logged in
$accountSvc = new AccountService();
$accountSvc->checkUserLoggedIn(true);

$loggedInAsAdmin = $accountSvc->isLoggedInAsAdmin();

// Get a list with all the accounts
$list = $accountSvc->getAccounts();

// Show the view
include 'presentation/userList.php';
