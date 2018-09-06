<!DOCTYPE HTML>
<html>
    <head>
        <meta charset=utf-8>
	<title>Inloggen</title>
	<style>
		body {
            margin: 0px auto;
			text-align: center;
        }
	</style>
    </head> 
    <body>
		<h1>Wachtwoord resetten</h1>
		<p>Gelieve uw e-mailadres in te geven, er zal een bevestigingsmail verstuurd worden bij het indienen.</p>
		<form action="../business/logIn.php" method="POST">
			<label for="mail">E-mail adres: </label><input type="email" name="mail" required>
			<input type="hidden" name="reset" value="1">
			<input type="submit" value="Indienen">
		</form>
	</body>
</html>