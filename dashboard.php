<?php

require_once("business/accountService.php");

$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();
$info       = $account->getInfo();

if ($info === null || $info == "") {
    header("location: editProfile.php");
} else {
    header("location: showProfile.php");
}
    