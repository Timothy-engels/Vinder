<?php
require_once('business/accountService.php');
require_once('business/matchingService.php');

// Check if an admin is logged in
$accountSvc      = new AccountService();
$loggedInAccount = $accountSvc->getLoggedInUser(true);
$menuItem        = "accounts-zonder-matches";

// Get the amount of matched and unmatched companies
$amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
$amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();

// Match met VDAB
$message = '';
$errors  = [];

// Show the view
include 'presentation/match-met-vdab.php';