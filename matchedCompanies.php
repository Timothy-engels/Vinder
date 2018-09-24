<?php

require_once 'business/accountService.php';

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get a list with the matched companies
$matchedCompanies = $accountSvc->getMatchedCompanies();

// Get an array with the amount of matches
$amountMatches = $accountSvc->getAmountMatchesByCompany();

// Show the view
include 'presentation/matchedCompanies.php';