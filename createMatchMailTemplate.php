<?php

require_once("business/accountService.php");

$accountService = new AccountService();
$company1       = $accountService->getById(28);
$company2       = $accountService->getCompleteAccountInfo(27);

include("presentation/createMatchMailTemplate.php");

