<?php
require_once("business/accountService.php");
require_once("business/validationService.php");

$accountSvc = new AccountService();
    
// Check if a user is logged in or if the confirmation code is given
if (filter_input(INPUT_GET, 'code') !== null) {
    
    $code          = filter_input(INPUT_GET, 'code');
    $decryptedCode = $accountSvc->decryptString($code, $accountSvc::FORGOTTEN_PASSWORD_KEY);
    
    $account = $accountSvc->getByEmail($decryptedCode);
    
    if ($account !== null) {
        $accountId = $account->getId();
    } else {
        header("location: logIn.php");
    }
    
    $urlExtension    = "?code=" . $code;
    $showMenu        = false;
    $loggedInAsAdmin = false;
    
} else {
    
    $accountSvc->checkUserLoggedIn();
    
    $code            = '';
    $accountId       = $accountSvc->getLoggedInAccountId();
    $urlExtension    = "";
    $showMenu        = true;
    $loggedInAsAdmin = $accountSvc->isLoggedInAsAdmin();    
    
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
    
    $passwordErrors = $validationSvc->checkRequiredAndMaxLength($password, 50);
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkMinLength($password, 8);
    }
    
    if ($passwordErrors === '') {
        $passwordErrors = $validationSvc->checkSafePassword($password);
    }
    
    if ($passwordErrors !== '') {
        $errors['password'] = $passwordErrors;
    }
    
    $repeatPasswordErrors = $validationSvc->checkRequiredAndMaxLength($repeatPassword, 50);

    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validationSvc->checkMinLength($repeatPassword, 8);
    }
    
    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validationSvc->checkSafePassword($repeatPassword);
    }
    
    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validationSvc->checkRepeatPassword($password, $repeatPassword);
    }
    
    if ($repeatPasswordErrors !== '') {
        $errors['repeatPassword'] = $repeatPasswordErrors;
    }
    
    if (empty($errors)) {
        
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        
        // Update the password
        $accountSvc->updatePassword($accountId, $passwordHash);
        
        // Show the confirmation
        include("presentation/updatePasswordSuccess.php");
        exit();
        
    }
    
}

include("presentation/updatePassword.php");