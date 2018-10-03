<?php

require_once 'business/accountService.php';
require_once ('business/matchingService.php');

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get al ist with the unmachted companies
$unmatchedCompanies = $accountSvc->getUnmatchedCompanies();

if (isset ($_POST["VDAB"]) && $_POST["VDAB"] == "match met VDAB") {

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
include 'presentation/unmatchedCompanies.php';