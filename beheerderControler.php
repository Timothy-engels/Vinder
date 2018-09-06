<?php

require_once 'business/beheerderService.php';

session_start();

$_Session["admin"] = true;

if ($_Session["admin"] == false){
    header('location: login.php');
}
else{
    
    $beheerder = new beheerder();
    $lijst = $beheerder -> lijstGebruikers();
    
    include 'presentation/lijstGebruikers.php';
}
