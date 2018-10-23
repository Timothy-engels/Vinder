<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");

// Check if user is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser();

// Is the user logged in as an admin
if ($loggedInAccount->getAdministrator() === "1") {
    $amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
    $amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
}

// Get the ID from the logged in user
$id = $loggedInAccount->getId();

// Get the necessary info to display the view
$account     = $loggedInAccount;
$expSrv      = new ExpertiseService();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

// Show the view
$info = $loggedInAccount->getInfo();

if ($info === null || $info == "") {
    $allExps = $expSrv->getExpertises();
    
    $info    = $loggedInAccount->getInfo();
    $website = $loggedInAccount->getWebsite();

    $myExpertises       = [];
    $expectedExpertises = [];
    $msg                = '';
    $errors             = [];

    foreach ($exps as $expertise) {
        $myExpertises[$expertise->getId()] = $expertise->getInfo();
    }
    
    $extraExpertise     = '';
    $extraExpertiseInfo = '';
    
    if ($extraExp !== null) {
        $extraExpertise     = $extraExp->getExpertise();
        $extraExpertiseInfo = $extraExp->getInfo();
    }
    
    foreach ($expExps as $expertise) {
        $expectedExpertises[$expertise->getId()] = $expertise->getInfo();
    }
    
    $extraExpected     = '';
    $extraExpectedInfo = '';
    
    if ($extraExpExp !== null) {
        $extraExpected     = $extraExpExp->getExpertise();
        $extraExpectedInfo = $extraExpExp->getInfo();
    }
    
    $menuItem = "profiel-wijzigen";
    include("presentation/profiel-wijzigen.php");
} else {
    $menuItem = "profiel-bekijken";
    include("presentation/profiel-bekijken.php");
}
    