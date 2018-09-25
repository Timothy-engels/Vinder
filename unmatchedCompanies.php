<?php

require_once 'business/accountService.php';

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get al ist with the unmachted companies
$unmatchedCompanies = $accountSvc->getUnmatchedCompanies();

// Show the view
include 'presentation/unmatchedCompanies.php';