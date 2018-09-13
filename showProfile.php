<?php
//get id from session


require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();


$usersSvc->checkUserLoggedIn();
$loggedInAsAdmin = $usersSvc->isLoggedInAsAdmin();
$id = $usersSvc->getLoggedInAccountId();



$account = $usersSvc->getById($id);

$expSrv = new ExpertiseService();
$exps = $expSrv->getExpertisesById($id);
$expExps = $expSrv->getExpectedExpertisesById($id);
$extraExp = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

include("presentation/accountShow.php");