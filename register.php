<?php
require_once("business/validationService.php");
require_once("business/accountService.php");
require_once("business/generalService.php");
require_once("business/validationService.php");
require_once("business/dateService.php");


// Get the posted values
$name           = (filter_input(INPUT_POST, 'name') !== null ? filter_input(INPUT_POST, 'name') : '');
$contactPerson  = (filter_input(INPUT_POST, 'contactPerson') !== null ? filter_input(INPUT_POST, 'contactPerson') : '');
$email          = (filter_input(INPUT_POST, 'email') !== null ? filter_input(INPUT_POST, 'email') : '');
$password       = (filter_input(INPUT_POST, 'password') !== null ? filter_input(INPUT_POST, 'password') : '');
$repeatPassword = (filter_input(INPUT_POST, 'repeatPassword') !== null ? filter_input(INPUT_POST, 'repeatPassword') : '');

// Get the end-date of the registration

$generalSvc = new GeneralService();
$general    = $generalSvc->get();

if ($general == null) {
    
    $registerMsg  = "<p>Het is momenteel niet mogelijk om je te registeren.  Probeer het later opnieuw.</p>";
    $registerMsg .= "<a href=\"logIn.php\">Naar de login-pagina</a>";
    
} else {
    
    // Get the register date
    $registryDate = $general->getRegisterDate();

    // Getting the current date
    $currentDate = new DateTime();
    $currentDate = $currentDate->format('Y-m-d H:i:s');

    // Checking if the registration date is expired
    $dateSvc         = new DateService();
    $registryExpired = $dateSvc->isBiggerThen($currentDate, $registryDate, 'Y-m-d H:i:s');

    // If expired, a message is given, if not, proceding
    if ($registryExpired) {
        
        $registerMsg  = "<p>Het is niet meer mogelijk om je te registreren.<br>De einddatum voor registratie is verlopen.</p>";
        $registerMsg .= "<a href=\"logIn.php\">Naar de login-pagina</a>";
        
    } else {
        
        // Check if the form is posted
        $errors = [];
            
        if ($_POST) {
    
            // Validate the fields
            $validation = new ValidationService();

            $nameErrors = $validation->checkRequiredAndMaxLength($name, 255);

            if ($nameErrors !== '') {
                $errors['name'] = $nameErrors;
            } 

            $contactPersonErrors = $validation->checkRequiredAndMaxLength($contactPerson, 255);

            if ($contactPersonErrors !== '') {
                $errors['contactPerson'] = $contactPersonErrors;
            }

            $emailErrors = $validation->checkRequiredAndMaxLength($email, 255); 

            if ($emailErrors === '') {
                $emailErrors = $validation->checkEmail($email);
            }

            if ($emailErrors == '') {
                $emailErrors = $validation->checkUniqueAccountEmail($email);
            }

            if ($emailErrors !== '') {
                $errors['email'] = $emailErrors;
            }

            $passwordErrors = $validation->checkRequiredAndMaxLength($password, 50);
     
            if ($passwordErrors === '') {
                $passwordErrors = $validation->checkMinLength($password, 8);
            }
    
            if ($passwordErrors === '') {
                $passwordErrors = $validation->checkSafePassword($password);
            }

            if ($passwordErrors !== '') {
                $errors['password'] = $passwordErrors;
            }

            $repeatPasswordErrors = $validation->checkRequiredAndMaxLength($repeatPassword, 50);

            if ($repeatPasswordErrors === '') {
                $repeatPasswordErrors = $validation->checkMinLength($repeatPassword, 8);
            }
    
            if ($repeatPasswordErrors === '') {
                $repeatPasswordErrors = $validation->checkSafePassword($repeatPassword);
            }
    
            if ($repeatPasswordErrors === '') {
                $repeatPasswordErrors = $validation->checkRepeatPassword($password, $repeatPassword);
            }
    
            if ($repeatPasswordErrors !== '') {
                $errors['repeatPassword'] = $repeatPasswordErrors;
            }
    
            if (empty($errors)) {
        
                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                // Save the account
                $newAccount = entities\Account::create(
                    null,
                    $name,
                    $contactPerson,
                    $email,
                    $password
                );
                        
                $accountSvc = new AccountService();
                $account    = $accountSvc->insert($newAccount);

                // Sent a confirmation mail
                $accountSvc->sendConfirmRegistrationMail($account);
        
                // Set a success message
                $registerMsg  = "<p>We hebben je registratie goed ontvangen.<br>We hebben je een mail gestuurd met een link om je account te activeren.</p>";
                $registerMsg .= "<a href=\"logIn.php\">Naar de login-pagina</a>";
                
            }
        }    
    }
}

// Show the view
include("presentation/register.php");