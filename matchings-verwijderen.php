<?php

require_once("business/accountService.php");
require_once("business/encryptionService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);
$menuItem        = "matchings-verwijderen";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Set success msg
$successMsg = "";
   
if ($_POST) {

    // Add the account ID & the current date the the confirmation string
    $now                = new DateTime();
    $confirmationString = $loggedInAccount->getID() . '|' . $now->format("Y-m-d H:i:s");
    
    // Send confirmation mail to administrator
    $encryptionSvc    = new EncryptionService();
    $confirmationCode = $encryptionSvc->encryptString(
        $confirmationString,
        $encryptionSvc::DELETE_MATCHING_STRING
    );
    
    // Generate the message
    $currentPath = $accountSvc->getCurrentPath();
    $link        = $currentPath . "deleteMatchingConfirmation.php?code=" . $confirmationCode;
    
    $msg = "<p>Beste, <br><br>
            Klik op de onderstaande link om de matchings te verwijderen:<br>
            <a href=\"" . $link . "\">Matchings verwijderen</a><br><br>
            Met vriendelijke groeten, <br>
            VDAB</p>";
    
    // Send the mail
    $mailSvc = new MailService();
    $mailSvc->sendHtmlMail($loggedInAccount->getEmail(), "Matchings verwijderen", $msg);
    
    $successMsg = "We hebben je een mail gestuurd met een link om de matchings te verwijderen.<br>Let op: de link in deze mail is <strong>slechts één uur geldig</strong>!";
    
}

// Show the view
include("presentation/matchings-verwijderen.php");