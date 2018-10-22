<?php
require_once("business/expertiseService.php");
require_once("business/accountService.php");
require_once ("business/validationService.php");

$accountSvc = new AccountService();

// Check if user is logged in
$loggedInAccount = $accountSvc->getLoggedInUser();
$menuItem        = "profiel-wijzigen";

// Get the amount of matched and unmatched companies
if ($loggedInAccount->getAdministrator() === "1") {
    $amountMatchedCompanies   = $accountSvc->getAmountMatchedCompanies();
    $amountUnmatchedCompanies = $accountSvc->getAmountUnmatchedCompanies();
}

// Get the ID from the logged in user
$id      = $loggedInAccount->getId();
$errors  = [];
$msg     = '';

// Get the necessary info to display the view
$expSrv      = new ExpertiseService();

$exps        = $expSrv->getExpertisesById($id);
$expExps     = $expSrv->getExpectedExpertisesById($id);
$extraExp    = $expSrv->getExtraExpertise($id);
$extraExpExp = $expSrv->getExtraExpectedExpertise($id);
$allExps     = $expSrv->getActiveExpertises();

$info    = (filter_input(INPUT_POST, 'info') !== null ? filter_input(INPUT_POST, 'info') : $loggedInAccount->getInfo());
$website = (filter_input(INPUT_POST, 'website') !== null ? filter_input(INPUT_POST, 'website') : $loggedInAccount->getWebsite());

$myExpertises       = [];
$expectedExpertises = [];

if ($_POST) {
    
    foreach ($allExps as $expertise) {
        if (filter_input(INPUT_POST, 'expertise' . $expertise->getId()) !== null) {
            $myExpertises[$expertise->getId()] = filter_input(INPUT_POST, 'inputexpertise' . $expertise->getId());
        }
        
        $extraExpertise     = filter_input(INPUT_POST, 'extraexpertise');
        $extraExpertiseInfo = filter_input(INPUT_POST, 'extraexpertiseinfo');
                
        if (filter_input(INPUT_POST, 'expected' . $expertise->getId()) !== null) {
            $expectedExpertises[$expertise->getId()] = filter_input(INPUT_POST, 'inputexpected' . $expertise->getId());
        }
        
        $extraExpected     = filter_input(INPUT_POST, 'extraexpected');
        $extraExpectedInfo = filter_input(INPUT_POST, 'extraexpectedinfo');
    }

} else {
    
    foreach ($exps as $expertise) {
        $myExpertises[$expertise->getId()] = $expertise->getInfo();
    }
    
    $extraExpertise     = '';
    $extraExpertiseInfo = '';
    
    if ($extraExp !== null) {
        $extraExpertise     = $extraExp->getExpertise();
        $extraExpertiseInfo = $extraExp->getInfo();
    }
    
    foreach ($expExps as $expertise) {
        $expectedExpertises[$expertise->getId()] = $expertise->getInfo();
    }
    
    $extraExpected     = '';
    $extraExpectedInfo = '';
    
    if ($extraExpExp !== null) {
        $extraExpected     = $extraExpExp->getExpertise();
        $extraExpectedInfo = $extraExpExp->getInfo();
    }
    
}

if ($_POST) {

    $target_dir  = "images/";
    
    $validationSvc = new ValidationService();
    
    if ($_FILES['fileToUpload']['size'] !== 0 &&  !empty($_FILES['fileToUpload'])) {
        
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));// Check if image file is a actual image or fake image
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $errors['logo'] = "De afbeelding moet van het type JPG, JPEG, PNG of GIF zijn.";
        }
        
        $check = @getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if ($check !== false) {
            if ($_FILES["fileToUpload"]["size"] > 10000000) {
                $errors['logo'] = "De afbeelding mag niet groter zijn dan 10MB.";
            }
        } else {
            $errors['logo'] = "Dit veld moet een geldige afbeelding bevatten.";
        }
    }    

    $infoErrors    = $validationSvc->checkRequiredAndMaxLength($info, 255);

    if ($infoErrors !== '') {
        $errors['info'] = $infoErrors;
    }

    if ($website !== '') {
        $websiteErrors = $validationSvc->checkMaxLength($website, 255);

        if ($websiteErrors === '') {
            $websiteErrors = $validationSvc->checkUrl($website);
        }

        if ($websiteErrors !== '') {
            $errors['website'] = $websiteErrors;
        }
    }

    if (empty($errors)) {

        if (isset($_POST['del'])){
            $oldlogo = $loggedInAccount->getLogo();
            if (is_file($target_dir . $oldlogo)) {
                unlink($target_dir . $oldlogo);
            }
            $loggedInAccount->setLogo("");
        };
    
        if ($_FILES['fileToUpload']['size'] !== 0 &&  !empty($_FILES['fileToUpload'])) {
            $newfilename = hash('sha256', $loggedInAccount->getEmail() . strval(time())) . "." . $imageFileType;

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir . $newfilename)) {

                $oldlogo = $loggedInAccount->getLogo($newfilename); // delete old logo!!!
                if (is_file($target_dir . $oldlogo)) {
                    unlink($target_dir . $oldlogo);
                }

                $loggedInAccount->setLogo($newfilename);            
            }
        }
                
        $loggedInAccount->setInfo($info);
        $loggedInAccount->setWebsite($website);
        $accountSvc->update($loggedInAccount);
        
        $expSrv->deleteExpertisesByUserId($id);
        foreach ($myExpertises as $expertiseId=>$expertiseInfo) {
            $expSrv->addExpertisesById($id, $expertiseId, $expertiseInfo);
        }
        
        $expSrv->deleteExpectedByUserId($id);
        foreach ($expectedExpertises as $expertiseId=>$expertiseInfo) {
            $expSrv->addExpectedExpertisesById($id, $expertiseId, $expertiseInfo);
        }
        
        $expSrv->deleteExtraExpertiseByUserId($id);
        $expSrv->addExtraExpertiseByUserId($id, $extraExpertise, $extraExpertiseInfo);

        $expSrv->deleteExtraExpectedByUserId($id);
        $expSrv->addExtraExpectedExpertiseByUserId($id, $extraExpected, $extraExpectedInfo);

        $msg = "Uw gegevens zijn met success gewijzigd.";
    }
}

include("presentation/profiel-wijzigen.php");



