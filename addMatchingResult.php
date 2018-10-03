<?php

require_once("business/accountService.php");
require_once("business/matchingService.php");

// Check if an admin is logged in
$accountSvc = new AccountService();
$account    = $accountSvc->getLoggedInUser();

// Get the company information
$currentAccountId = $account->getID();
$swipedAccountId  = filter_input(INPUT_GET, 'swipingCompanyId');
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
    
    if ($status === 3) {
        $accountSvc->sendMatchFoundMails($currentAccountId, $swipedAccountId);
    }
    
} else {
    
    $status = $matchingSvc->getStatusFromSwipingResults($answer, null);
    $matchingSvc->insert($currentAccountId, $swipedAccountId, $status);
    
}