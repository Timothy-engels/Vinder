<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");

// Get the confirmation code
$code = $_GET["code"];

// Get the decrypted confirmation code
$encryptionSvc = new EncryptionService();
$decryptedCode = $encryptionSvc->decryptString(
    $code,
    $encryptionSvc::CONFIRM_REGISTRATION_KEY
);

// Get the result
$result = "<p>Er is een onbekende fout opgetreden.</p>";

if ($decryptedCode !== '') {

    // Get the account identifiers
    list($accountId, $accountEmail) = explode('|', $decryptedCode);

    // Get the account by ID
    $accountSvc = new AccountService();
    $account    = $accountSvc->getById($accountId);
    
    // Check if account is valid
    if ($account !== null) {
        
        if ($account->getEmail() === $accountEmail) {
            
            $loginUrl = $accountSvc->getCurrentPath() . "logIn.php";
            
            // Check if account is already confirmed
            if (!$account->getConfirmed()) {
                
                // Confirm the account
                $confirmation = $accountSvc->confirmRegistration($accountId);

                if ($confirmation) {
                    $result = "<p>Uw registratie is bevestigd!<br /><br />";
                    $result .= "<a href=\"" . $loginUrl . "\">Klik hier om in te loggen</a>.</p>";
                } 
                
            } else {
                
                $result = "<p>Uw registratie was reeds bevestigd!<br /><br />";
                $result .= "<a href=\"" . $loginUrl . "\">Klik hier om in te loggen</a>.</p>";
                
            }
        }
    }

}

include("presentation/confirmRegistration.php");
