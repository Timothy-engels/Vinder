<?php

    require_once("business/accountService.php");
        
    $accService = new accountService();
    $accService->checkUserLoggedIn(true);
    
    if($_GET["eaid"] != null) {
        $_SESSION["eaid"] = $_GET["eaid"];
    }
    
    if(!isset($_SESSION["eaid"])) {
        header("location: expertises.php");
    }
    
    if(isset($_POST["update"])) {
        $eaid = $_SESSION["eaid"];
        $_POST["eaid"] = null;
        $expertise = $_POST["update"];
        $_POST["update"] = null;
        $update = new expertiseDAO();
        $update->update($expertise, $eaid);
        print($eaid);
        print("<br>" . $expertise);
        header("location: expertises.php");
    }
       
    include("presentation/showExpertiseAdjust.php");