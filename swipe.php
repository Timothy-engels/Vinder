<?php
//swipe.php

require_once("business/accountService.php");
require_once("business/expertiseService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser();
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

/* hier is Cindy momenteel mee bezig (Het systeem haalt een lijst op van alle bedrijven waarvoor de ingelogde gebruiker nog niet heeft geswiped om zo mogelijke matches te bekomen)
$candidates = ->();

$swipes = array();

for each($candidates as $swipeProfile) {
    $id = $swipeProfile->getId();
    $swipeProfile = $accountSvc->getSwipingInfo($id);
    $swipes[$id][0] = $swipeProfile;
}*/

// ergens moet ook de expertises opgevraagd worden en bij in de array gezet

$json = serialize($account);

include("presentation/swipeCard.php");