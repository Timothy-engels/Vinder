<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");

// Load the services
$accountSvc    = new AccountService();
$encryptionSvc = new EncryptionService();

// Get the company from the url
$companyIDEncoded = filter_input(INPUT_GET, 'companyID');

if ($companyIDEncoded !== null && $companyIDEncoded !== '') {
    $encryptionSvc = new EncryptionService();
    $companyID     = $encryptionSvc->decryptString($companyIDEncoded, $encryptionSvc::SWIPE_KEY);
    
    // Get the company information
    $company = $accountSvc->getCompleteAccountInfo($companyID);
    
    // Get the current path
    $currentPath = $accountSvc->getCurrentPath();

    include("presentation/swipeCardHtml.php");
}

// TODO@VDAB : FOUTMELDING GEVEN WANNEER INFORMATIE NIET GEVONDEN IS
