<?php
require_once("business/accountService.php");
require_once("business/generalService.php");
require_once("business/encryptionService.php");

$companyToString    = filter_input(INPUT_GET, 'companyTo');
$companyMatchString = filter_input(INPUT_GET, 'companyMatch');

if ($companyToString !== null && $companyToString !== '' && $companyMatchString !== null && $companyMatchString !== '') {
  
    $encryptionSvc  = new EncryptionService();
    $companyToId    = $encryptionSvc->decryptString($companyToString, $encryptionSvc::MAIL_MATCH_KEY);
    $companyMatchID = $encryptionSvc->decryptString($companyMatchString, $encryptionSvc::MAIL_MATCH_KEY);
    
    // Get the company information
    $accountService = new AccountService();
    $company1       = $accountService->getById($companyToId);
    $company2       = $accountService->getCompleteAccountInfo($companyMatchID);

    if ($company1 !== null && $company2 !== null) {
        
        // Get the current path
        $currentPath    = $accountService->getCurrentPath();

        // Get the tips
        $generalSvc = new GeneralService();
        $general    = $generalSvc->get();
        $tips       = html_entity_decode($general->getMail());
        
        include("presentation/createMatchMailTemplate.php");
    }
    
}