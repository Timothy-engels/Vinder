<?php
//accountEdit.php

$id=3;
require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();
$account = $usersSvc->getById($id);

$expSrv = new ExpertiseService();
$exps = $expSrv->getExpertisesById($id);
$expExps = $expSrv->getExpectedExpertisesById($id);
$extraExp = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);

include("presentation/accountEdit.php");