<?php
require_once("business/accountService.php");
require_once("business/validationService.php");
require_once("business/mailService.php");

$mail = (filter_input(INPUT_POST, 'mail') !== null ? filter_input(INPUT_POST, 'mail') : '');

$errors = [];

if ($_POST) {
    
    // Validate the fields
    $validation = new ValidationService();
    
    $mailErrors = $validation->checkRequiredAndMaxLength($mail, 255); 

    if ($mailErrors === '') {
        $mailErrors = $validation->checkEmail($mail);
    }
    
    if ($mailErrors === '') {
        $accountSvc = new AccountService();
        $account    = $accountSvc->getByEmail($mail);
        
        if ($account === null) {
            $mailErrors = "Onbekend e-mailadres.";
        }
    }
    
    if ($mailErrors !== '') {
        $errors['mail'] = $mailErrors;
    }
    
    if (empty($errors)) {
        
        // Get the encryption key
        $code = $accountSvc->encryptString($mail, $accountSvc::FORGOTTEN_PASSWORD_KEY);
        
        // Generate the message
        $currentPath = $accountSvc->getCurrentPath();
        $link        = $currentPath . "updatePassword.php?code=" . $code;
        
        $msg = "<p>Beste, <br><br>
                Klik op de onderstaande link om je wachtwoord te resetten:<br>
                <a href=\"" . $link . "\">Reset je wachtwoord</a><br><br>
                Met vriendelijke groeten,<br>
                VDAB</p>";
        
        // Send the mail
        $mailSvc = new MailService();
        $mailSvc->sendHtmlMail($mail, "Vinder | Wachwoord vergeten", $msg);
        
        include("presentation/forgotPasswordSuccess.php");
        die();
    }
}

include("presentation/forgotPassword.php");