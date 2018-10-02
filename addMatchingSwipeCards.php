<?php
require_once("business/accountService.php");

// Check if a user is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();

// Check if there are current swipe cards on the screen
$currentSwipeCardIds = filter_input(INPUT_GET, 'currentSwipeCardIds');       

// Get the swiping information
$swipingInfo = $accountSvc->getCompleteSwipingInfo(
    $account->getId(),
    $currentSwipeCardIds
);

// Get the swipe card info
$currentPath = $accountSvc->getCurrentPath();

// Show the view
include("presentation/addMatchingSwipeCards.php");