<?php
require_once 'business/login.php';

$log = new login();
$logout = $log -> logout();

include 'presentation/login.php';