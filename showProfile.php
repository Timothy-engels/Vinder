<?php
//get id from session

$id=3;
require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();
$account = $usersSvc->getById($id);

$expSrv = new ExpertiseService();
$exps = $expSrv->getExpertisesById($id);



include("presentation/accountShow.php");