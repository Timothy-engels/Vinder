<?php
require_once("business/accountService.php");

$email = $_GET["email"];
$hash = $_GET["hash"];

$accountService = new AccountService();
$accountService->resetPass("kamil@bebenek.net");


$verify = password_verify ( $email.'bdzGYFykq54t2m5j4AuKJhOViW1VmcnS' , $hash);

if($verify){
    $accountService = new AccountService();
    $confirm = $accountServiceervice->confirmAccount($email);

    if($confirm){
        echo "<br>Bevestiging van het account was succesvol";
    }
    else
        echo "<br>Bevestiging van het account was mislukt. Waarschijnlijk het account is al geactiveerd";
}else
    echo "code of e-mail is niet correct";
