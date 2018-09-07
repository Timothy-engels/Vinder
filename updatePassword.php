<?php
require_once("business/validationService.php");

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
    
}

include("presentation/updatePassword.php");