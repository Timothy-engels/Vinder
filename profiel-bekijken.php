<?php

require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once("business/matchingService.php");

$accountSvc = new AccountService();

// Check if user is logged in
$loggedInAccount = $accountSvc->getLoggedInUser();

// Get the amount of matched and unmatched companies
if ($loggedInAccount->getAdministrator() === "1") {
    $amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
    $amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
}

// Get the ID from the logged in user
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id !== null) {
    
    $account = $accountSvc->getById($id);
    
    if ($account !== null) {
        
        if ($loggedInAccount->getAdministrator() !== "1") {
            
            $matchingSvc = new matchingService();
            $match       = $matchingSvc->getMatch($loggedInAccount, $account);

            if ($match === null OR $match->getStatus() !== "3") {
                echo "U heeft geen rechten om deze pagina te bekijken.";
                die();
            }
            
        }
        
    } else {
        
        echo "Er is een onbekende fout opgetreden.";
        die();
        
    }
    
} else {
    
    $account = $loggedInAccount;
    $id      = $account->getId();
    
}

// Get the necessary info to display the view
$expSrv      = new ExpertiseService();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

include("presentation/profiel-bekijken.php");