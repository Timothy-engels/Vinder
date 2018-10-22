<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");
require_once("business/validationService.php");

$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser();

$code            = '';
$accountId       = $loggedInAccount->getId();
$urlExtension    = "";

if ($loggedInAccount->getAdministrator() === "1") {
    $amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
    $amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
}
    
// Initialize the values
$errors  = [];
$message = '';

// Get the posted values
$password       = (filter_input(INPUT_POST, 'password') !== null ? filter_input(INPUT_POST, 'password') : '');
$repeatPassword = (filter_input(INPUT_POST, 'repeatPassword') !== null ? filter_input(INPUT_POST, 'repeatPassword') : '');

if ($_POST) {
    
    // Validate the fields
    $validationSvc = new ValidationService();
    $errors        = $validationSvc->validatePasswords($password, $repeatPassword);
    
    if (empty($errors)) {
        
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // Update the password
        $loggedInAccount->setPassword($passwordHash);
        $accountSvc->update($loggedInAccount);
        
        // Show the confirmation
        $message = "Je wachtwoord is met succes gewijzigd.";
        
    }
    
}

include("presentation/updatePassword.php");