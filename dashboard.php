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
    include("presentation/accountEdit.php");
} else {
    $menuItem = "profiel-bekijken";
    include("presentation/profiel-bekijken.php");
}
    