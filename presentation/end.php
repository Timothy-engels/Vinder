<?php
    
    session_start();
    
    if (isset($_SESSION["ID"])) {
        $id = $_SESSION["ID"];
    }
    else {
        header("location: logInForm.php");
    }
    if (isset($_POST["logOut"])) {
		$_POST["logOut"] = NULL;
		session_destroy();
		header("location: logInForm.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Aangemeld!</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body {
		margin: 0px auto;
		text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Profielpagina(alleen de uitlog-knop werkt)</h1>
		<form action="../processor/processor.php" method="POST">
			<p><label for="mail">Contactpersoon aanpassen: </label><input type="email" name="mail" required></p>
			<!--<p><label for="mail">Website aanpassen: </label><input type="url" name="mail" required></p>
			<p><label for="mail">Logo aanpassen: </label><input type="" name="mail" required></p>
			<p><label for="mail">Info aanpassen: </label><input type="text" name="mail" required></p>
            <p><label for="mail">E-mail aanpassen: </label><input type="email" name="mail" required></p>-->
            <p><label for="pass">Wachtwoord aanpassen: </label><input type="password" name="pass" required></p>
            <input type="hidden" name ="adjust" value="1">
            <p><input type="reset" value="Reset"><input type="submit" value="Aanpassen"></p>
		</form>
		<form  action="../business/logOut.php" method="POST">
			<input type="hidden" name="logOut" value="1">
			<input type="submit"value="Uitloggen">
		</form>
        <?php
            print("<p>De SESSION id is: " . $id . "</p>");
        ?>
    </body>
</html>