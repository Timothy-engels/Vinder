<?php

require_once 'business/accountService.php';
require_once ('business/matchingService.php');

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get al ist with the unmachted companies
$unmatchedCompanies = $accountSvc->getUnmatchedCompanies();

// match with admin/VDAB
$matchSvc = new matchingService();

if (isset ($_POST["VDAB"]) && $_POST["VDAB"] == "match met VDAB"){

    $idAdmin = $account->getId();
    $status = 3;
    foreach ( $unmatchedCompanies as $uC){
        
        // retrieving ID
        $idUnmatchedCompany = $uC->getId();
        
        // insert into DB
        $MatchWithAdmin = $matchSvc->insert($idAdmin, $idUnmatchedCompany, $status);
        
        // sent matching mail
        $mailTo = $accountSvc->sendMatchFoundMails($idAdmin, $idUnmatchedCompany);
            
    }   
    // Get al ist with the unmachted companies
    $unmatchedCompanies = $accountSvc->getUnmatchedCompanies();
}



// Show the view
include 'presentation/unmatchedCompanies.php';