<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once("business/accountService.php");
require_once("business/validationService.php");

// Redirect to the login page when the user is already logged in
if (isset($_SESSION["ID"])) {
    header("location: dashboard.php");
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
        
        $accountSvc = new AccountService();
        $account    = $accountSvc->getByEmail($mail);
        
        if ($account !== null) {
            
            if ($account->getConfirmed() === "1") {

                if (password_verify($pass, $account->getPassword())) {
                    
                    $_SESSION["ID"]    = $account->getId();
                    $_SESSION["admin"] = ($account->getAdministrator() === "1" ? true : false);
                    
                    header("location: dashboard.php");
                    
                } else {
                    
                    $errors["general"] = "Foutief e-mailadres of wachtwoord.";
                    
                }
                
            } else {
                
                $errors["general"] = "U moet eerst uw registratie bevestigen voordat u kan inloggen.";
                
            }
            
        } else {
            
            $errors["general"] = "Foutief e-mailadres of wachtwoord.";
            
        }
    }
            
}
        
// Show the view
include("presentation/logInV2.php");
