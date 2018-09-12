<?php

session_start();

require_once("business/accountService.php");
require_once("business/validationService.php");

// Redirect to the login page when the user is already logged in
if (isset($_SESSION["ID"])) {
    header("location: ingelogd.php");
}

// Set the general values
$errors = [];

// Get the posted values
$mail = (filter_input(INPUT_POST, 'mail') !== null ? filter_input(INPUT_POST, 'mail') : '');
$pass = (filter_input(INPUT_POST, 'pass') !== null ? filter_input(INPUT_POST, 'pass') : '');

if ($_POST) {
    
    // Validate the  user input
    $validationSvc = new ValidationService();
    
    $mailErrors = $validationSvc->checkRequiredAndMaxLength($mail, 255);
    
    if ($mailErrors === '') {
        $mailErrors = $validationSvc->checkEmail($mail);
    }
    
    if ($mailErrors !== '') {
        $errors['mail'] = $mailErrors;
    }
    
    $passErrors = $validationSvc->checkRequiredAndMaxLength($pass, 50);
    
    if ($passErrors === '') {
        $passErrors = $validationSvc->checkMinLength($pass, 8);
    }
    
    if ($passErrors !== '') {
        $errors['pass'] = $passErrors;
    }
    
    if (empty($errors)) {
        $log = new AccountService();
        $log->logIn($mail, $pass);
    }

}

// Show the view
include("presentation/logInForm.php");
