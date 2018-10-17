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



$return_arr = array();
if ($match !== null) {
    if ($match->getStatus() == 3) {
        $return_arr[] = array("id"=>$swipedAccountId,"name"=>$swipedAccount->getName(),"logo"=>$swipedAccount->getLogo());
        echo json_encode($return_arr);
    }
}