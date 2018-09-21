<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");

$usersSvc = new AccountService();

// Check if user is logged in
$account = $usersSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the ID from the logged in user
$id = $account->getId();

// Get the necessary info to display the view
$expSrv      = new ExpertiseService();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);
$allExps     = $expSrv->getExpertises();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expSrv->deleteExpertisesByUserId($id);
    $expSrv->deleteExpectedByUserId($id);
    foreach ($allExps as $e){
        if($_POST['expertise'.$e->getId()]){ //check if checkbox is checked
            $expSrv->addExpertisesById($id,$e->getId(),$_POST['inputexpertise'.$e->getId()]);
        };
    }
    foreach ($allExps as $e){
        if($_POST['expected'.$e->getId()]){ //check if checkbox is checked
            $expSrv->addExpectedExpertisesById($id,$e->getId(),$_POST['inputexpected'.$e->getId()]);
        };
    }
    $expSrv->addExtraExpertiseByUserId($id,$_POST['extraexpertise'],$_POST['extraexpertiseinfo']);

    header("Location: editProfile.php");
} else{

    include("presentation/accountEdit.php");
};


