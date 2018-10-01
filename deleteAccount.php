<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once('business/matchingService.php');

$accountSvc = new AccountService();
$expSrv      = new ExpertiseService();
$matchSrv      = new MatchingService();

// Check if user is logged in
$account = $accountSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the ID from the logged in user
$id = $account->getId();

if(!isset($_POST['pass'])) {
    $_POST['pass'] = "";
}

if(!isset($_POST['del'])) {
    $_POST['del'] = "";
}

if (($_SERVER['REQUEST_METHOD'] === 'POST') and $_POST['pass']) {
    if (password_verify($_POST['pass'],$account->getPassword())) {

        //remove matches
        $matchSrv->deleteByUserId($id);

        //remove expertises
        $expSrv->deleteExpertisesByUserId($id);
        $expSrv->deleteExpectedByUserId($id);
        $expSrv->deleteExtraExpertiseByUserId($id);
        $expSrv->deleteExtraExpectedByUserId($id);


        @$oldlogo = $account->getLogo($newfilename);
        unlink('images/' . $oldlogo);//logo from server remove

        $usersSvc->deleteById($id);//remove account

        echo "Account deleted"; //log out
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
    }else{
        $message = "Wrong password";
        include("presentation/accountDelete.php");
    }
}elseif(($_GET["id"]) and $loggedInAsAdmin ){
    $id = ($_GET["id"]);
    $account = $accountSvc->getById($id);
    if ($account){
        if($_POST['del'] === $id){

            //remove matches
            $matchSrv->deleteByUserId($id);

            //remove expertises
            $expSrv->deleteExpertisesByUserId($id);
            $expSrv->deleteExpectedByUserId($id);
            $expSrv->deleteExtraExpertiseByUserId($id);
            $expSrv->deleteExtraExpectedByUserId($id);


            @$oldlogo = $account->getLogo($newfilename);
            @unlink('images/' . $oldlogo);//logo from server remove

            $accountSvc->deleteById($id);//remove account

            echo "Account id: ".$id." is verwijderd.<br>
                  <a href='userList.php'>Terug naar lijst</a>";
        }else include("presentation/accountDeleteAdmin.php");

    }
    else{
        echo "account bestaat niet";
    }
    }
else
    {


    include("presentation/accountDelete.php");
}