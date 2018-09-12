<?php
require_once("business/accountService.php");
require_once("business/generalService.php");
require_once("business/validationService.php");

// Check if an admin is logged in
$accountSvc = new AccountService();
$accountSvc->checkUserLoggedIn(true);

$loggedInAsAdmin = $accountSvc->isLoggedInAsAdmin();

// Set the default values
$errors  = [];
$message = '';

// Get the current values
$generalSvc = new GeneralService();
$general    = $generalSvc->get();

$dbMail = '';

if ($general !== null) {
    $dbMail = $general->getMail();
} else {
    $general = entities\General::create('', '', '');
}

// Get the posted values
$mail = (filter_input(INPUT_POST, 'mail') !== null ? filter_input(INPUT_POST, 'mail') : $dbMail);

// Check if the form is posted
if ($_POST) {
    
    // Validate the fields
    $validationSvc = new ValidationService();
    
    $mailErrors = $validationSvc->checkRequired($mail);
    
    if ('' !== $mailErrors) {
        $errors['mail'] = $mailErrors; 
    }
    
    if (empty($errors)) {

        $general->setMail($mail);
        $generalSvc->updateMail($general);
        
        $message = "De gegevens zijn met succes gewijzigd.";
    }
    
}

// Show the view
include("presentation/mailUpdate.php");