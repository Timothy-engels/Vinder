<?php
//accountEdit.php

// ophalen van gebruikers gegevens
require_once ('business/accountService.php');

$usersSvc = new AccountService();
$accounts = $usersSvc->getAccounts();

include('presentation/accountEdit.php');