<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once('business/matchingService.php');
require_once('business/validationService.php');

$accountSvc = new AccountService();
$expSrv     = new ExpertiseService();
$matchSrv   = new MatchingService();

// Check if user is logged in
$account = $accountSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the ID from the logged in user
$id = $account->getId();

// Set the general message
$message = "";
$errors  = [];

if ($_POST) {
    
    $validationSvc = new ValidationService();
    
    $password       = filter_input(INPUT_POST, 'pass');
    $passwordErrors = $validationSvc->checkRequiredAndMaxLength($password, 50);
    
    if ($passwordErrors !== '') {
        $errors['pass'] = $passwordErrors;
    }
    
    if (!password_verify($password, $account->getPassword())) {
        $errors['pass'] = 'Foutief wachtwoord';
    }
    
    if (empty($errors)) {
    
        //remove matches
        $matchSrv->deleteByUserId($id);

        //remove expertises
        $expSrv->deleteExpertisesByUserId($id);
        $expSrv->deleteExpectedByUserId($id);
        $expSrv->deleteExtraExpertiseByUserId($id);
        $expSrv->deleteExtraExpectedByUserId($id);

        $oldlogo = $account->getLogo();
        if (file_exists('images/' . $oldlogo)) {
            unlink('images/' . $oldlogo);//logo from server remove
        }

        $accountSvc->deleteById($id);//remove account

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        
        include("presentation/account-verwijderd.php");
        die();
    }
        
}

include("presentation/account-verwijderen.php");
