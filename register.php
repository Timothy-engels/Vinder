<?php
require_once("business/validationService.php");
require_once("business/accountService.php");
require_once("business/generalService.php");
require_once("business/validationService.php");


// Get the posted values
$name           = (filter_input(INPUT_POST, 'name') !== null ? filter_input(INPUT_POST, 'name') : '');
$contactPerson  = (filter_input(INPUT_POST, 'contactPerson') !== null ? filter_input(INPUT_POST, 'contactPerson') : '');
$email          = (filter_input(INPUT_POST, 'email') !== null ? filter_input(INPUT_POST, 'email') : '');
$password       = (filter_input(INPUT_POST, 'password') !== null ? filter_input(INPUT_POST, 'password') : '');
$repeatPassword = (filter_input(INPUT_POST, 'repeatPassword') !== null ? filter_input(INPUT_POST, 'repeatPassword') : '');

// Getting the end-date of the registration
$generalSvc = new GeneralService();
$general = $generalSvc->get();
$registryDate = $general->getRegisterDate();

// Getting the current date
$currentDate = date("Y-m-d H:i:s");

// Checking if the registration date is expired
$validationSvc = new ValidationService();
$validation = $validationSvc->registryExpired($registryDate, $currentDate);

// If expired, head back to the logIn page
if($validation) {
    header("location: logIn.php");
}

print("Registratiedatum: " . $registryDate . "<br> Huidige datum: " . $currentDate);

// Check if the form is posted

$errors = []; 

if ($_POST) {
    
    // Validate the fields
    $validation = new ValidationService();

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

        $accountService->sendConfirmRegistrationMail($account);
        
        // Show the confirmation
        include("presentation/registerSuccess.php");
        exit();
    }
   
}

// Show the view
include("presentation/register.php");