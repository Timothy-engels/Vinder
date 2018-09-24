<?php
/*swipe.php

require_once("business/swipeService.php");
require_once("business/expertiseService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser(true);
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// hierop is het nog even op Cindy wachten
$candidateSvc = new CandidateService();
$candidates = $candidateSvc->getAll();

$swipes = array();

for each($candidates as $swipeProfile) {
    $id = $swipeProfile->getId();
    $swipeProfile = $accountSvc->getSwipeProfile($id);
    push_array($swipes, $swipeProfile);
}

include("presentation/");*/