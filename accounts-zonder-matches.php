<?php
require_once('business/accountService.php');
require_once('business/generalService.php');
require_once('business/matchingService.php');

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);
$menuItem        = "accounts-zonder-matches";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Get al list with the unmachted companies
$unmatchedCompanies = $accountSvc->getUnmatchedCompanies();

// Check is the matching with VDAB is available
$matchWithVdab = false;

$generalSvc = new GeneralService();
$general    = $generalSvc->get();

if ($general !== null) {
    
    // Get the start date for matching
    $endSwipeDate      = DateTime::createFromFormat("Y-m-d H:i:s", $general->getSwipeDate());
    $startMatchingDate = $endSwipeDate->add(new DateInterval("P1D"));
    
    // Get the current date
    $currentDate = new DateTime();
    
    if ($currentDate > $startMatchingDate) {
        $matchWithVdab = true;
    }
    
}

// Show the view
include 'presentation/accounts-zonder-matches.php';