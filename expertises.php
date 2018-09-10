<?php

    require_once("business/accountService.php");
    require_once("business/expertiseService.php");
    
    $accService = new accountService();
    $accService->checkUserLoggedIn(true);

    $expertSvc = new ExpertiseService();
    $expertises = $expertSvc->getExpertises();

    include("presentation/expertisesList.php");

    