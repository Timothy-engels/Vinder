<?php
	
    class Validation {
			
    public function validate($mail, $pass) {
	$conn = new PDO("mysql:host=localhost; dbname=vinder; charset=utf8", "Admin", "KnockKnock");
	$query = "SELECT ID FROM accounts WHERE Emailadres = :mail AND Wachtwoord = :pass";															
	$transfer = $conn->prepare($query);
	$conn = null;
	$transfer->execute(array(":mail"=>$mail, ":pass"=>$pass));
	$answer = $transfer->fetch(PDO::FETCH_ASSOC);
        $id = $answer["ID"];
	return $id;
	}
    }

	

