<?php

require_once("business/accountService.php");
include("presentation/accountList.php");

$usersSvc = new AccountService();
$accounts = $usersSvc->getAccounts();


include("presentation/accountList.php");
