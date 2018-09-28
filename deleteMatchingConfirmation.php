<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");
require_once("business/dateService.php");
require_once("business/matchingService.php");

// Get the confirmation code
$code = filter_input(INPUT_GET, 'code');

// Get the result message
$result = "Er is een onbekende fout opgetreden.<br>De matchings kunnen niet worden verwijderd!";

if ($code !== null) {
    
    // Get the decrypted confirmation code
    $encryptionSvc = new EncryptionService();
    $encryptedCode = $encryptionSvc->decryptString(
        $code,
        $encryptionSvc::DELETE_MATCHING_STRING
    );

    // Split the code into the accountId & the date
    list($accountId, $urlDate) = explode('|', $encryptedCode);
    
    // Check if the account exists
    $accountSvc = new AccountService();
    $account    = $accountSvc->getById($accountId);
    
    if ($account !== null) {
        
        // Check if the account is an admin        
        if ($account->getAdministrator() === "1") {
            
            // Get the current date - 1 hour 
            $currentDate  = new DateTime();
            $adjustedDate = $currentDate->sub(new DateInterval("PT1H"));
            $adjustedDate = $adjustedDate->format('Y-m-d H:i:s');

            // Check if the url date is bigger than the adjusted date
            $dateSvc = new dateService();
            
            if ($dateSvc->isBiggerThen($urlDate, $adjustedDate, 'Y-m-d H:i:s')) {
                
                // Delete the matches
                $matchingSvc = new matchingService();
                $matchingSvc->deleteAll();
                
                // Set the result msg
                $result = "De matchings zijn met succes verwijderd.";
                
            } else {
                
                // Set the error message
                $result = "Deze bevestigingslink is verlopen!";
                
            }            
        }
    }
}

include ('presentation/deleteMatchingConfirmation.php');