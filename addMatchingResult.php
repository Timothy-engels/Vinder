<?php

require_once("business/accountService.php");

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();

// Get the data for the ajax request
$answer = filter_input(INPUT_GET, 'answer');
        
// TODO@VDAB -> gegevens aan db toevoegen en voeg resultaat bewerking toe aan
$result = 'true';
  
if ($result === 'true') {
    
    // Remove the first company from the swiping information
    $swipingInfo = $_SESSION['swipingInfo'];
    array_shift($swipingInfo);
    $_SESSION['swipingInfo'] = $swipingInfo;
    
}

echo $result;