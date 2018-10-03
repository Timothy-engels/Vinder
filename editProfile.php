<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once ("business/validationService.php");

$usersSvc = new AccountService();

// Check if user is logged in
$account = $usersSvc->getLoggedInUser();

// Is the user logged in as an admin
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the ID from the logged in user
$id = $account->getId();




// Get the necessary info to display the view
$expSrv      = new ExpertiseService();
$validationSvc = new ValidationService();
$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);
$allExps     = $expSrv->getExpertises();

$msg2='';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $info           = (filter_input(INPUT_POST, 'Info') !== null ? filter_input(INPUT_POST, 'Info') : $account->getInfo());
    $website          = (filter_input(INPUT_POST, 'website') !== null ? filter_input(INPUT_POST, 'website') : $account->getWebsite());


    $nameErrors = $validationSvc->checkRequiredAndMaxLength($info, 255);

    if ($nameErrors !== '') {
        $errors['Info'] = $nameErrors;
    }

    $nameErrors = $validationSvc->checkRequiredAndMaxLength($website, 255);

    if ($nameErrors !== '') {
        $errors['website'] = $nameErrors;
    }

    if (empty($errors)) {


        $account->setInfo($info);
        $account->setWebsite($website);
        $usersSvc->update($account);

        //$msg = "Uw gegevens zijn met success aangepast.";

    }

    echo $_FILES['fileToUpload']['size'];
    if ($_FILES['fileToUpload']['size']!==0 and !empty($_FILES['fileToUpload'])) {
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));// Check if image file is a actual image or fake image
        $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        $uploadOk = 1;
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            $msg2 = "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($check !== false) {
            if ($_FILES["fileToUpload"]["size"] > 10000000) {
                $msg2 = "Sorry, your file is too large. Max 10MB";
                $uploadOk = 0;
            }// Allow certain file formats
            if ($uploadOk !== 0) {
                $newfilename = hash('sha256', $account->getEmail() . strval(time())) . "." . $imageFileType;
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {
                    $oldlogo = $account->getLogo($newfilename); // delete old logo!!!
                    if (is_file($target_dir . $oldlogo)) {
                        unlink($target_dir . $oldlogo);
                    }
                    $account->setLogo($newfilename);
                    $usersSvc->update($account);
                    $msg = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
                    $msg2 = '';
                }
            }
        } else {

            $uploadOk = 0;
        }
    }


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

    $expSrv->deleteExtraExpertiseByUserId($id);
    $expSrv->deleteExtraExpectedByUserId($id);
    $expSrv->addExtraExpertiseByUserId($id, $_POST['extraexpertise'], $_POST['extraexpertiseinfo']);
    $expSrv->addExtraExpectedExpertiseByUserId($id, $_POST['extraexpected'], $_POST['extraexpectedinfo']);


}


include("presentation/accountEdit.php");



