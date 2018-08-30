<?php

require_once("business/AccountService.php");
include("presentation/showUsers.php");

$usersSvc = new AccountService();
$accounts = $usersSvc->getAccounts();