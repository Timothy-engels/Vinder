<?php
require_once("business/validationService.php");
require_once("business/accountService.php");

// Load the necessary services
$accountSvc    = new AccountService();
$validationSvc = new ValidationService();

// Check if the user is logged in
$accountSvc->checkUserLoggedIn();
$loggedInAsAdmin = $accountSvc->isLoggedInAsAdmin();

// Get the account information
$accountId = $accountSvc->getLoggedInAccountId();
$account   = $accountSvc->getById($accountId);

if ($account === null) {
    header("location: logIn.php");
}

// Set the variables
$errors = [];
$msg    = '';

// Get the posted values
$name           = (filter_input(INPUT_POST, 'name') !== null ? filter_input(INPUT_POST, 'name') : $account->getName());
$contactPerson  = (filter_input(INPUT_POST, 'contactPerson') !== null ? filter_input(INPUT_POST, 'contactPerson') : $account->getContactPerson());
$email          = (filter_input(INPUT_POST, 'email') !== null ? filter_input(INPUT_POST, 'email') : $account->getEmail());


if ($_POST) {
    // Validate the fields
    $nameErrors = $validationSvc->checkRequiredAndMaxLength($name, 255);
    
    if ($nameErrors !== '') {
        $errors['name'] = $nameErrors;
    }
    
    $contactPersonErrors = $validationSvc->checkRequiredAndMaxLength($contactPerson, 255);

    if ($contactPersonErrors !== '') {
        $errors['contactPerson'] = $contactPersonErrors;
    }
    
    $emailErrors = $validationSvc->checkRequiredAndMaxLength($email, 255); 

    if ($emailErrors === '') {
        $emailErrors = $validationSvc->checkEmail($email);
    }
    
    if ($emailErrors == '') {
        $emailErrors = $validationSvc->checkUniqueAccountEmail($email, $accountId);
    }
    
    if ($emailErrors !== '') {
        $errors['email'] = $emailErrors;
    }
    
    if (empty($errors)) {
        
        // Update the contactinfo
        $account->setName($name);
        $account->setContactPerson($contactPerson);
        $account->setEmail($email);
        
        $accountSvc->update($account);
        
        $msg = "Uw gegevens zijn met success aangepast.";
        
    }
}
// Show the view
include("presentation/contactUpdate.php");

