<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");
require_once("business/validationService.php");

// Get the code to specify the user
$code = filter_input(INPUT_GET, 'code');

// Decrypt the code to get the mailadres of the user
$encryptionSvc = new EncryptionService();
$decryptedCode = $encryptionSvc->decryptString(
    $code,
    $encryptionSvc::FORGOTTEN_PASSWORD_KEY
);

// Check if user exists
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getByEmail($decryptedCode);

if ($loggedInAccount !== null) {
    $accountId = $loggedInAccount->getId();
} else {
    header("location: logIn.php");
}

// Initialize the values
$errors          = [];
$message         = '';

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
        $message = "<p>Je wachtwoord is met success gereset.<br><a href='logIn.php'>Klik hier om je opnieuw in te loggen.</a></p>";
        
    }
    
}

include("presentation/wachtwoord-resetten.php");
