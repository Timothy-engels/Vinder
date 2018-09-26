<?php
require_once("entities/general.php");
require_once("business/dateService.php");
require_once("business/generalService.php");
require_once("business/validationService.php");
require_once("business/accountService.php");

// Check if an admin is logged in
$accountSvc      = new AccountService();
$account         = $accountSvc->getLoggedInUser(true);
$loggedInAsAdmin = ($account->getAdministrator() === "1" ? true : false);

// Get the current values
$generalService = new GeneralService();
$general        = $generalService->get();

$dbRegisterDate = '';
$dbSwipeDate    = '';

if ($general !== null) {
    $dateService    = new DateService();
    $dbRegisterDate = $dateService->dateDbToString($general->getRegisterDate(), '-');
    $dbSwipeDate    = $dateService->dateDbToString($general->getSwipeDate(), '-');
}

// Get the posted values
$registerDate = (filter_input(INPUT_POST, 'registerDate') !== null ? filter_input(INPUT_POST, 'registerDate') : $dbRegisterDate);
$swipeDate    = (filter_input(INPUT_POST, 'swipeDate') !== null ? filter_input(INPUT_POST, 'swipeDate') : $dbSwipeDate);

// Check if the form is posted
$errors  = [];
$message = '';

if ($_POST) {
    
    // Validate the fields
    $validation = new ValidationService();
    
    $registerDateErrors = $validation->checkRequiredAndMaxLength($registerDate, 10);
    
    if ('' === $registerDateErrors) {
        $registerDateErrors = $validation->checkValidDate($registerDate);
    }
    
    if ('' !== $registerDateErrors) {
        $errors['registerDate'] = $registerDateErrors;
        $registerDate = null;
    }
    
    $swipeDateErrors = $validation->checkRequiredAndMaxLength($swipeDate, 10);

    if ('' === $swipeDateErrors) {
        $swipeDateErrors = $validation->checkValidDate($swipeDate); 
    }
    
    if ('' !== $swipeDateErrors) {
        $errors['swipeDate'] = $swipeDateErrors;
        $swipeDate = null;
    }
    
    if ($registerDate !== null && $swipeDate !== null) {
        $swipeDateErrors = $validation->checkDateBiggerThen(
            $registerDate,
            $swipeDate,
            'Einddatum registratie',
            'Startdatum swipen'
        );
        
        if ($swipeDateErrors !== '') {
            $errors['swipeDate'] = $swipeDateErrors;
        }
    }
    
    if (empty($errors)) {
        
        $dateSvc = new DateService();
        
        $dbRegisterDate = $dateSvc->dateToDbString($registerDate, '-');
        $dbSwipeDate    = $dateSvc->dateToDbString($swipeDate, '-');
        
        if ($general === null) {
            $general = entities\General::create($dbRegisterDate, $dbSwipeDate, '');
        } else {
            $general->setRegisterDate($dbRegisterDate);
            $general->setSwipeDate($dbSwipeDate);
        }
        
        $generalService = new GeneralService();
        $generalService->updateDates($general);
        
        $message = "De gegevens zijn met succes gewijzigd.";
        
    }
    
}

// Show the view
include("presentation/updateDateSettings.php");
