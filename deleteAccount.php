<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();
$expSrv      = new ExpertiseService();

// Check if user is logged in
$account = $usersSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the ID from the logged in user
$id = $account->getId();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expSrv->deleteExpertisesByUserId($id);
    $expSrv->deleteExpectedByUserId($id);
    $expSrv->deleteExtraExpertiseByUserId($id);
    $expSrv->deleteExtraExpectedByUserId($id);
}else{
    include("presentation/accountDelete.php");
}