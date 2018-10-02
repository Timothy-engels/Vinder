<?php
//swipe.php
require_once("business/accountService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser();
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Admins can't swipe
if ($loggedInAsAdmin) {
    header("location: dashboard.php");
}

// Get the swiping information
$swipingInfo = $accountSvc->getCompleteSwipingInfo($account->getId()); 

// Get the current path
$currentPath = $accountSvc->getCurrentPath();

// Show the view
include("presentation/test.php");