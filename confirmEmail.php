<?php
require_once("business/accountService.php");

$email = $_GET["email"];
$hash = $_GET["hash"];


$verify = password_verify ( $email.'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS' , $hash);

if($verify){
    $confrimService = new AccountService();
    $confirm = $confrimService->confirmAccount($email);

    if($confirm){
        echo "<br>Bevestiging van het account was succesvol";
    }
    else
        echo "<br>Bevestiging van het account was mislukt. Waarschijnlijk het account is al geactiveerd";
}else
    echo "code of e-mail is niet correct";