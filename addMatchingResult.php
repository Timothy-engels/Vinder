<?php

require_once("business/accountService.php");
require_once("business/matchingService.php");

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();

// Get the swiping information
$swipingInfo = $_SESSION['swipingInfo'];

// Get the company information
$currentAccountId = $account->getID();
$swipedAccountId  = $_SESSION['swipingInfo'][0];
$swipedAccount    = $accountSvc->getById($swipedAccountId);

// Check if a matching already exists for the companies
$matchingSvc = new matchingService;
$match       = $matchingSvc->getMatch($account, $swipedAccount);

// Get the data for the ajax request
$answer = filter_input(INPUT_GET, 'answer');

if ($match !== null) {
    
    $tmpSwipedResult = $matchingSvc->getSwipeResultsFromStatus($match->getStatus());
    
    if ($match->getAccount1()->getID() === $currentAccountId) {
        $swipeResultAccount1 = $answer;
        $swipeResultAccount2 = $tmpSwipedResult['swipeAccount2'];
    } else {
        $swipeResultAccount1 = $tmpSwipedResult['swipeAccount1'];
        $swipeResultAccount2 = $answer;        
    }
    
    $status = $matchingSvc->getStatusFromSwipingResults(
        $swipeResultAccount1,
        $swipeResultAccount2
    );
    
    $match->setStatus($status);
    $matchingSvc->update($match);
    
} else {
    
    $status = $matchingSvc->getStatusFromSwipingResults($answer, null);
    $matchingSvc->insert($currentAccountId, $swipedAccountId, $status);
}
        
// TODO@VDAB -> Resultaat bewerking testen
$result = 'true';
  
if ($result === 'true') {
    
    // Remove the first company from the swiping information
    $swipingInfo = $_SESSION['swipingInfo'];
    array_shift($swipingInfo);
    $_SESSION['swipingInfo'] = $swipingInfo;
    
}

echo $result;