<?php
// matchingController.php

require_once('business/accountService.php');

// Load the account service
$accountSvc = new AccountService();

// Get the information of the logged in user
$account = $accountSvc->getLoggedInUser();

// Get an array with the matched companies
$mO = $accountSvc->getMatchedCompanies($account->getID());

include ('presentation/matches.php');