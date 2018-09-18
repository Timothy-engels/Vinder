<?php
//accountEdit.php

require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();

$account         = $usersSvc->getLoggedInUser();
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);
$id              = $account->getId();

$expSrv      = new ExpertiseService();
$allExps     = $expSrv->getExpertises();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

include("presentation/accountEdit.php");