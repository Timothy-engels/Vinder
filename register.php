<?php
require_once("business/validationService.php");
require_once("business/accountService.php");

// Get the posted values
$name           = (filter_input(INPUT_POST, 'name') !== null ? filter_input(INPUT_POST, 'name') : '');
$contactPerson  = (filter_input(INPUT_POST, 'contactPerson') !== null ? filter_input(INPUT_POST, 'contactPerson') : '');
$email          = (filter_input(INPUT_POST, 'email') !== null ? filter_input(INPUT_POST, 'email') : '');
$password       = (filter_input(INPUT_POST, 'password') !== null ? filter_input(INPUT_POST, 'password') : '');
$repeatPassword = (filter_input(INPUT_POST, 'repeatPassword') !== null ? filter_input(INPUT_POST, 'repeatPassword') : '');

// Check if the form is posted

if ($_POST) {
    
    // Validate the fields
    $validation = new ValidationService();
    $errors     = []; 

    $nameErrors = $validation->checkRequiredAndMaxLength($name, 255);

    if ($nameErrors !== '') {
        $errors['name'] = $nameErrors;
    } 

    $contactPersonErrors = $validation->checkRequiredAndMaxLength($contactPerson, 255);

    if ($contactPersonErrors !== '') {
        $errors['contactPerson'] = $contactPersonErrors;
    }

    $emailErrors = $validation->checkRequiredAndMaxLength($email, 255); 

    if ($emailErrors === '') {
        $emailErrors = $validation->checkEmail($email);
    }
    
    if ($emailErrors == '') {
        $emailErrors = $validation->checkUniqueAccountEmail($email);
    }
    
    if ($emailErrors !== '') {
        $errors['email'] = $emailErrors;
    }

    $passwordErrors = $validation->checkRequiredAndMaxLength($password, 50);
    
    if ($passwordErrors === '') {
        $passwordErrors = $validation->checkMinLength($password, 8);
    }
    
    if ($passwordErrors === '') {
        $passwordErrors = $validation->checkSafePassword($password);
    }

    if ($passwordErrors !== '') {
        $errors['password'] = $passwordErrors;
    }

    $repeatPasswordErrors = $validation->checkRequiredAndMaxLength($repeatPassword, 50);

    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validation->checkMinLength($repeatPassword, 8);
    }
    
    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validation->checkSafePassword($repeatPassword);
    }
    
    if ($repeatPasswordErrors === '') {
        $repeatPasswordErrors = $validation->checkRepeatPassword($password, $repeatPassword);
    }
    
    if ($repeatPasswordErrors !== '') {
        $errors['repeatPassword'] = $repeatPasswordErrors;
    }
    
    if (empty($errors)) {
        
        // Hash the password
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Save the account
        $accountService = new AccountService();
        $account        = $accountService->insert(
            $name,
            $contactPerson,
            $email,
            $passwordHash
        );

        $sendEmail = new AccountService();
        $sendEmail->sendEmail($email);
        
        // Show the confirmation
        include("presentation/registerSuccess.php");
        exit();
    }
   
}

// Show the view
include("presentation/register.php");