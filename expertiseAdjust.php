<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");

$accService = new accountService();
$account    = $accService->getLoggedInUser(true);

if ($_GET["eaid"] != null) {
    $eaid = $_GET["eaid"];
} else {
    header("location: expertises.php");
}

if(isset($_POST["update"])) {

    $expertise = $_POST["update"];
    $update = new expertiseService();
    $update->updateExpertise($expertise, $eaid);
    header("location: expertises.php");
}

include("presentation/showExpertiseAdjust.php");