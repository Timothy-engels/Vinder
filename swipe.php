<?php
//swipe.php
require_once("business/accountService.php");
require_once("business/expertiseService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser();
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the swiping information
$swipingInfo = $accountSvc->getSwipingInfo($account->getId()); // TODO@VDAB -> expertises uit lijst halen, tenzij ze ergens anders gebruikt worden

// Add the swiping information to the session
$_SESSION["swipingInfo"] = $swipingInfo;

// Get the swipe card info
$swipeCardHtml = $accountSvc->getSwipeCardHtml();

// Show the view
include("presentation/swipeCard.php");