<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");


$usersSvc = new AccountService();

// Check if user is logged in
$account = $usersSvc->getLoggedInUser(true);

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
    foreach ($allExps as $e) {
        if ($_POST['expertise' . $e->getId()]) { //check if checkbox is checked
            $expSrv->addExpertisesById($id, $e->getId(), $_POST['inputexpertise' . $e->getId()]);
        };
    }
    foreach ($allExps as $e) {
        if ($_POST['expected' . $e->getId()]) { //check if checkbox is checked
            $expSrv->addExpectedExpertisesById($id, $e->getId(), $_POST['inputexpected' . $e->getId()]);
        };
    }


    $expSrv->addExtraExpertiseByUserId($id, $_POST['extraexpertise'], $_POST['extraexpertiseinfo']);
    $expSrv->addExtraExpectedExpertiseByUserId($id, $_POST['extraexpected'], $_POST['extraexpectedinfo']);

    $photostatus = 'aaa';
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $photostatus = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            $photostatus=  "Sorry, there was an error uploading your file.";
        }
    }
    include("presentation/accountEdit.php");
    echo $photostatus;



} else{

    include("presentation/accountEdit.php");
};


