<?php

session_start();

    require_once("../business/accountService.php");

    if(isset($_POST["logOut"])) {
        $log = new AccountService();
        $log->logOut();
    }