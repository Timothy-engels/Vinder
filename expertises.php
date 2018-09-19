<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");
require_once("business/validationService.php");
    
$accService      = new accountService();
$account         = $accService->getLoggedInUser(true);
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

$validation    = '';
$message       = '';
$newExpertise  = '';

if (isset($_POST["newExpertise"])) {
    
    $newExpertise  = $_POST["newExpertise"];
    $validationSvc = new ValidationService();
    
    $validation = $validationSvc->checkRequiredAndMaxLength($newExpertise, 255);
    
    if ($validation === "") {
        $validation = $validationSvc->checkUniqueExpertise($newExpertise);
    }
    
    if ($validation === "") {           
        $expertSvc  = new ExpertiseService();
        $expertSvc->addExpertise($newExpertise);
        
        $message      = 'De gegevens zijn met succes toegevoegd.';
        $newExpertise = '';
    }
}

$expertSvc  = new ExpertiseService();
$expertises = $expertSvc->getExpertises();

include("presentation/expertisesList.php");

    