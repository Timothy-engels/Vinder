<?php
require_once 'business/accountService.php';

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
$menuItem                 = "accounts-met-matches";

// Check if an account id is given
$accountId   = filter_input(INPUT_GET, 'id');
$accountInfo = null;    

if ($accountId !== null) {
    
    // Get the account information
    $accountInfo = $accountSvc->getById($accountId);

    if ($accountInfo === null) {
        $accountId     = null;
    }
    
    // Set the title
    $title = "Accounts gematched aan " . $accountInfo->getName();
    
} 

if ($accountInfo === null) {
    
    //Get an array with the amount of matches
    $amountMatches = $accountSvc->getAmountMatchesByCompany();
    
    // Set the title
    $title = "Accounts met matches";
    
}

// Get a list with the matched companies
$matchedCompanies = $accountSvc->getMatchedCompanies($accountId);

// Show the view
include 'presentation/accounts-met-matches.php';