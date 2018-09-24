<?php

require_once 'business/accountService.php';

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser(true);

$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the company information
$companyId   = filter_input(INPUT_GET, 'companyId');
$companyInfo = $accountSvc->getById($companyId);

if ($companyInfo === null) {
    header('location: matchedCompanies.php');
}

// Get a list with the matched companies
$matchedCompanies = $accountSvc->getMatchedCompanies($companyId);

// Show the view
include('presentation/matchedCompaniesTo.php');


