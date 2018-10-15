<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");
require_once("business/validationService.php");
    
// Check if an admin is logged in
$accService      = new accountService();
$loggedInAccount = $accService->getLoggedInUser(true);
$menuItem        = 'expertises';

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accService->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accService->getAmountUnmatchedCompanies();

$validation    = '';
$message       = '';
$newExpertise  = '';

if ($_POST) {
    
    $newExpertise  = $_POST["newExpertise"];
    $validationSvc = new ValidationService();
    
    $validation = $validationSvc->checkRequiredAndMaxLength($newExpertise, 255);
    
    if ($validation === "") {
        $validation = $validationSvc->checkUniqueExpertise($newExpertise);
    }
    
    if ($validation === "") {           
        $expertSvc = new ExpertiseService();
        $expertise = Expertise::create(null, $newExpertise);
        
        $expertSvc->addExpertise($expertise);
        
        $message      = 'De gegevens zijn met succes toegevoegd.';
        $newExpertise = '';
    }
}

$expertSvc  = new ExpertiseService();
$expertises = $expertSvc->getExpertises();

include("presentation/expertises.php");

    