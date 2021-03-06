<?php
require_once("business/accountService.php");
require_once("business/encryptionService.php");
require_once("business/validationService.php");
require_once("business/mailService.php");

$mail = (filter_input(INPUT_POST, 'mail') !== null ? filter_input(INPUT_POST, 'mail') : '');

$errors     = [];
$successMsg = '';

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
        $encryptionSvc = new EncryptionService();
        $code          = $encryptionSvc->encryptString(
            $mail,
            $encryptionSvc::FORGOTTEN_PASSWORD_KEY
        );
        
        // Generate the message
        $currentPath = $accountSvc->getCurrentPath();
        $link        = $currentPath . "wachtwoord-resetten.php?code=" . $code;
        
        $msg = "<p>Beste, <br><br>
                Klik op de onderstaande link om je wachtwoord te resetten:<br>
                <a href=\"" . $link . "\">Reset je wachtwoord</a><br><br>
                Met vriendelijke groeten,<br>
                VDAB</p>";
        
        // Send the mail
        $mailSvc = new MailService();
        $mailSvc->sendHtmlMail($mail, "Wachtwoord vergeten", $msg);
        
        $successMsg = "We hebben je een mail gestuurd met een link om je wachtwoord te resetten.";
        
    }
}

include("presentation/wachtwoord-vergeten.php");