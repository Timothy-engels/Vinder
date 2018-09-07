<?php

require_once 'business/accountService.php';

// Check if a admin is logged in
$accountSvc = new AccountService();
$accountSvc->checkUserLoggedIn(true);

// Get a list with all the accounts
$lijst = $accountSvc->getAccounts();

// Show the view
include 'presentation/lijstGebruikers.php';
