<?php
//swipe.php
require_once("business/accountService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser();
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the swiping information
$swipingInfo = $accountSvc->getCompleteSwipingInfo($account->getId()); 

// Get the swipe card info
$currentPath   = $accountSvc->getCurrentPath();
$swipeCardHtml = $accountSvc->getSwipeCardHtml();

// Show the view
include("presentation/test.php");