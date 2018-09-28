<?php
require_once("business/accountService.php");

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();

echo $accountSvc->getSwipeCardHtml();