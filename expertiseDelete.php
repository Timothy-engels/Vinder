<?php
require_once("business/accountService.php");
require_once("business/expertiseService.php");

$accService = new accountService();
$account    = $accService->getLoggedInUser(true);
    
if ($_GET["edid"] === null) {
    header("location: expertises.php");
}

$edid   = $_GET["edid"];
$delete = new expertiseService();
$delete->deleteExpertise($edid);

header("location: expertises.php");

