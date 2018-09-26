<?php
// matchingController.php

require_once ('business/matchingService.php');

$mS = new matchingService() ;
$mO = $mS->getMatchOverzicht();

include ('presentation/matches.php');