<?php

require_once 'business/accountService.php';

// Check if a admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);

// Set the menu item
$menuItem = "accounts";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Get a list with all the accounts
$list = $accountSvc->getAccounts();

// Show the view
include 'presentation/accounts.php';
