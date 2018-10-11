<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once('business/matchingService.php');
require_once('business/validationService.php');

$accountSvc = new AccountService();
$expSrv     = new ExpertiseService();
$matchSrv   = new MatchingService();

// Check if user is logged in
$loggedInAccount = $accountSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($loggedInAccount->getAdministrator() === "1" ? true : false);

// Set the general message
$message      = "";
$errors       = [];
$urlExtension = '';

$deleteAccountId = filter_input(INPUT_GET, 'id');

if ($deleteAccountId !== null) {
    
    if ($loggedInAccount->getAdministrator() === "1" ) {
        $deleteAccount = $accountSvc->getById($deleteAccountId);
        if ($deleteAccount === null) {
             $message = "Er is een onbekende fout opgetreden!";
        } else {
            $urlExtension = '?id=' . $deleteAccountId;
        }
    } else {
        $message = "U heeft geen rechten om deze pagina te bekijken!";
    }
    
} else { 
    $deleteAccount   = $loggedInAccount;
    $deleteAccountId = $loggedInAccount->getId();   
}

if ($message === '' && $deleteAccount->getAdministrator() === "1") {
    // Admin account can't be deleted
    $message = "Deze account is de administrator account.<br>Je mag deze account niet verwijderen!";
}

if ($_POST) {
    
    $validationSvc = new ValidationService();
    
    $password       = filter_input(INPUT_POST, 'pass');
    $passwordErrors = $validationSvc->checkRequiredAndMaxLength($password, 50);
    
    if ($passwordErrors !== '') {
        $errors['pass'] = $passwordErrors;
    }
    
    if (!password_verify($password, $loggedInAccount->getPassword())) {
        $errors['pass'] = 'Foutief wachtwoord';
    }
    
    if (empty($errors)) {
    
        //remove matches
        $matchSrv->deleteByUserId($deleteAccountId);

        //remove expertises
        $expSrv->deleteExpertisesByUserId($deleteAccountId);
        $expSrv->deleteExpectedByUserId($deleteAccountId);
        $expSrv->deleteExtraExpertiseByUserId($deleteAccountId);
        $expSrv->deleteExtraExpectedByUserId($deleteAccountId);

        // Remove the logo
        $logo = $deleteAccount->getLogo();
        if ($logo !== '' && $logo !== null && file_exists('images/' . $logo)) {
            unlink('images/' . $logo);//logo from server remove
        }
        // Delete the account
        $accountSvc->deleteById($deleteAccountId);//remove account

        if ($loggedInAccount->getAdministrator() === "1") {
            
            header("location: userList.php");
            
        } else { 
            // Log out
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            session_destroy();

            include("presentation/account-verwijderd.php");
            die();
        }
    }
        
}

include("presentation/account-verwijderen.php");
