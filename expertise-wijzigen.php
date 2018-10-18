<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");
require_once("business/validationService.php");

// Check if user is logged in
$accService      = new accountService();
$loggedInAccount = $accService->getLoggedInUser(true);
$menuItem        = 'expertises';

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accService->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accService->getAmountUnmatchedCompanies();

// Get the current expertise
$expertiseId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($expertiseId === null || $expertiseId === '') {
    header("location: expertises.php");
}

$expertiseSvc = new ExpertiseService();
$expertise    = $expertiseSvc->getById($expertiseId);

if ($expertise === null) {
    header("location: expertises.php");
}

$expertiseName       = (filter_input(INPUT_POST, 'expertise') !== null ? filter_input(INPUT_POST, 'expertise') : $expertise->getExpertise());
$expertiseActive     = (filter_input(INPUT_POST, 'active') !== null ? filter_input(INPUT_POST, 'active') : ($_POST ? "0" : (string) $expertise->getActive()));
$expertiseNameErrors = '';

if ($_POST) {
    
    // Validate the fields
    $validationSvc = new ValidationService();
    
    $expertiseNameErrors = $validationSvc->checkRequiredAndMaxLength($expertiseName, 255);
    
    if ($expertiseNameErrors === '') {
        $expertiseNameErrors = $validationSvc->checkUniqueExpertise($expertiseName, $expertise->getId());
    }
   
    if ($expertiseNameErrors === '') {
        
        $expertise->setExpertise($expertiseName);
        $expertise->setActive($expertiseActive);

        $expertiseSvc->updateExpertise($expertise);

        header("location: expertises.php");
    }
}

include("presentation/expertise-wijzigen.php");
