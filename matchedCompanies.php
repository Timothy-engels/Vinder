<?php

require_once 'business/accountService.php';

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
    
// Get a list with the matched companies
$matchedCompanies = $accountSvc->getMatchedCompanies();

// Get an array with the amount of matches
$amountMatches = $accountSvc->getAmountMatchesByCompany();

// Show the view
include 'presentation/matchedCompanies.php';