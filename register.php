<?php

var_dump($_POST);

//$post_data = file_get_contents("php://input");
//var_dump($post_data);

// Validate the fields
$errors = []; 

//if (array_key_exists($_POST['name']) && trim($_POST['name']) === '') {
//    $errors['name'] = "Dit is een verplicht veld";
//} 

include("view/register.php");