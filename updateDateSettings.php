<?php
require_once("business/validationService.php");

// Get the posted values
$registerDate = (filter_input(INPUT_POST, 'registerDate') !== null ? filter_input(INPUT_POST, 'registerDate') : '');
$swipeDate    = (filter_input(INPUT_POST, 'swipeDate') !== null ? filter_input(INPUT_POST, 'swipeDate') : '');

// Check if the form is posted

$errors = [];

if ($_POST) {
    
    // Validate the fields
    $validation = new ValidationService();
    
    $registerDateErrors = $validation->checkValidDate($registerDate);
    
    if ('' !== $registerDateErrors) {
        $errors['registerDate'] = $registerDateErrors;
        $registerDate = null;
    }
    
    $swipeDateErrors = $validation->checkValidDate($swipeDate);
    
    if ('' !== $swipeDateErrors) {
        $errors['swipeDate'] = $swipeDateErrors;
        $swipeDate = null;
    }
    
    if ($registerDate !== null && $swipeDate !== null) {
        $swipeDateErrors = $validation->checkDateBiggerThen(
            $registerDate,
            $swipeDate,
            'Startdatum registratie',
            'Startdatum swipen'
        );
        
        if ($swipeDateErrors !== '') {
            $errors['swipeDate'] = $swipeDateErrors;
        }
    }
    
}

// Show the view
include("presentation/updateDateSettings.php");
