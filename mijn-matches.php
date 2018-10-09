<?php
// matchingController.php

require_once('business/accountService.php');

// Load the account service
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser();
$menuItem        = "mijn-matches";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Get an array with the matched companies
$matchedAccounts = $accountSvc->getMatchedCompanies($loggedInAccount->getID());

include ('presentation/mijn-matches.php');