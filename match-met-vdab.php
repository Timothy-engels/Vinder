<?php
require_once('business/accountService.php');
require_once('business/generalService.php');
require_once('business/matchingService.php');
require_once('business/validationService.php');

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);
$menuItem        = "accounts-zonder-matches";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Set parameters
$message = '';
$errors  = [];

// Get a list with the unmachted companies
$unmatchedAccounts = $accountSvc->getUnmatchedCompanies();

if (empty($unmatchedAccounts)) {
    $message = "Er zijn momenteel geen accounts die gematched kunnen worden aan de VDAB.";
}

// Check if the swiping is over
if ($message === '') {
    
    $generalSvc = new GeneralService();
    $general    = $generalSvc->get();

    if ($general === null) {

        $message = "Het is momenteel niet mogelijk om te matchen met de VDAB.<br>Probeer later opnieuw.";

    } else {

        // Get the start date for matching
        $endSwipeDate      = DateTime::createFromFormat("Y-m-d H:i:s", $general->getSwipeDate());
        $startMatchingDate = $endSwipeDate->add(new DateInterval("P1D"));

        // Get the current date
        $currentDate = new DateTime();

        if ($currentDate < $startMatchingDate) {
            $message = "Het is momenteel nog niet mogelijk om te matchen.<br>Probeer na " . $startMatchingDate->format("d-m-Y") . " opnieuw.";
        }

    }
}

// Match met VDAB
if ($message === '' && $_POST) {
    
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    // Validate the password
    $validationSvc  = new ValidationService();
    $passwordErrors = $validationSvc->checkRequiredAndMaxLength($password, 50);
    
    if ($passwordErrors !== '') {
        $errors['password'] = $passwordErrors;
    }
    
    if ($passwordErrors === '' && !password_verify($password, $loggedInAccount->getPassword())) {
        $errors['password'] = 'Foutief wachtwoord';
    }
    
    if (empty($errors)) {
        
        $adminId     = $loggedInAccount->getId();
        $matchingSvc = new matchingService();
        
        foreach ($unmatchedAccounts as $account) {
            
            $unmatchedAccountId = $account->getId();
            
            // Insert the information into the db
            $matchingSvc->insert($adminId, $unmatchedAccountId, 3);
            
            // Sent matching mail
            $accountSvc->sendMatchFoundMails($adminId, $unmatchedAccountId);
            
            // Return to list with unmatched companies
            header("location: accounts-zonder-matches.php");
            
        }
    }
}

// Show the view
include 'presentation/match-met-vdab.php';