<?php

// Validate the fields
$errors = []; 

if (array_key_exists('name', $_POST)) {
    
    if (trim($_POST['name']) === '') {
        $errors['name'] = "Dit is een verplicht veld";
    } 
    
    if (array_key_exists('name', $_POST) && strlen($_POST['name']) > 255) {
        $errors['name'] = "Het veld mag maximaal 255 karakters bevatten";
    }

} else {
    
    $errors['name'] = "Dit is een verplicht veld";
    
}

include("view/register.php");