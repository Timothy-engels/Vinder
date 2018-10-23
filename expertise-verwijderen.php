<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");

$accService      = new accountService();
$loggedInAccount = $accService->getLoggedInUser(true);
    
$expertiseId = filter_input(INPUT_GET, 'edid', FILTER_VALIDATE_INT);

if ($expertiseId === null) {
    header("location: expertises.php");
}

// Check if expertise is linked to an account
$expertiseSvc = new expertiseService();

if ($expertiseSvc->checkExpertiseIsUsed($expertiseId)) {
    $amountMatchedCompanies   = $accService->getAmountMatchedCompanies();
    $amountUnmatchedCompanies = $accService->getAmountUnmatchedCompanies();

    include 'presentation/expertise-verwijderen.php';
} else {
    $expertiseSvc->deleteExpertise($expertiseId);
    header("location: expertises.php");
}

