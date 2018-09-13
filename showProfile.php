<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();

// Check if user is logged in
$usersSvc->checkUserLoggedIn();

// Is the user logged in as an admin
$loggedInAsAdmin = $usersSvc->isLoggedInAsAdmin();

// Get the ID from the logged in user
$id = $usersSvc->getLoggedInAccountId();

// Get the necessary info to display the view
$account = $usersSvc->getById($id);

$expSrv      = new ExpertiseService();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

include("presentation/accountShow.php");