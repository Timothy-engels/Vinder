<?php

    require_once("business/accountService.php");
    require_once("data/expertiseDAO.php");
        
    $accService = new accountService();
    $accService->checkUserLoggedIn(true);
    
    $_SESSION["eaid"] = $_GET["eaid"];
    
    if(!isset($_SESSION["eaid"])) {
        //header("location: expertises.php");
    }
    
    if(isset($_POST["update"])) {
        $eaid = $_SESSION["eaid"];
        $_POST["eaid"] = null;
        $expertise = $_POST["update"];
        $_POST["update"];
        $update = new expertiseDAO();
        $update->update($expertise, $eaid);
        print($eaid);
        print("<br>" . $expertise);
        //header("location: expertises.php");
    }
       
    include("presentation/showExpertiseAdjust.php");