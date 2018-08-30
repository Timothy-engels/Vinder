<?php
	
    if($_POST["process"]) {
        header("location: logInForm.php");
    }

    $_POST["process"] = TRUE;
    
    class Validation {
			
    public function getId($mail) {
	$conn = new PDO("mysql:host=localhost; dbname=vinder; charset=utf8", "Admin", "KnockKnock");
	$query = "SELECT ID FROM accounts WHERE Emailadres = :mail";															
	$transfer = $conn->prepare($query);
	$conn = null;
	$transfer->execute(array(":mail"=>$mail));
	$answer = $transfer->fetch(PDO::FETCH_ASSOC);
        $id = $answer["ID"];
	return $id;
	}
        
    public function getPassword($id) {
	$conn = new PDO("mysql:host=localhost; dbname=vinder; charset=utf8", "Admin", "KnockKnock");
	$query = "SELECT Wachtwoord FROM accounts WHERE ID = :id";															
	$transfer = $conn->prepare($query);
	$conn = null;
	$transfer->execute(array(":id"=>$id));
	$answer = $transfer->fetch(PDO::FETCH_ASSOC);
        $hash = $answer["Wachtwoord"];
	return $hash;
	}
    }

	

