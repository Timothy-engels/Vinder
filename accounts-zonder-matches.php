<?php
require_once 'business/accountService.php';
require_once ('business/matchingService.php');

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);
$menuItem        = "accounts-zonder-matches";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Get al ist with the unmachted companies
$unmatchedCompanies = $accountSvc->getUnmatchedCompanies();

if (isset ($_POST["VDAB"]) && $_POST["VDAB"] == "Match met VDAB") {

    // Get ID from admin company
    $idAdmin = $account->getId();
    
    // Set the status
    $status  = 3;
    
    // Match with admin
    $matchSvc = new matchingService();

    foreach ($unmatchedCompanies as $uC) {
        
        // Get ID from second company company
        $idUnmatchedCompany = $uC->getId();
        
        // Insert into DB
        $MatchWithAdmin = $matchSvc->insert($idAdmin, $idUnmatchedCompany, $status);
        
        // Sent matching mail
        $accountSvc->sendMatchFoundMails($idAdmin, $idUnmatchedCompany);
            
    }   
    
    // Get a list with the unmatched companies
    $unmatchedCompanies = $accountSvc->getUnmatchedCompanies();
}

// Show the view
include 'presentation/accounts-zonder-matches.php';