<?php

require_once("business/accountService.php");

$usersSvc = new AccountService();
$accounts = $usersSvc->getAccounts();

include("presentation/accountList.php");