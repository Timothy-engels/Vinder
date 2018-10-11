<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Profiel Pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<?php include('menu.php'); ?>

<form action="account-verwijderen.php" method="post" enctype="multipart/form-data">
    <div class="container" >
        <h1> Account verwijderen  </h1>
        <h3 style="color: red"><?php if($message)echo $message?></h3>
        <h2>Geef je wachtwoord in om de account <?php echo $account->getEmail(); ?> te verwijderen.</h2>
        <div class="row">
            <span >Wachtwoord * :</span>
            <input type="password" name="pass" placeholder="" value = "">
            <?php if (array_key_exists('pass', $errors)) : ?>
                <div class="errors"><?= $errors['pass']; ?></div>
            <?php endif; ?>
        </div>
        <input type="submit" class="btn" name="submit" value="Verwijder">
    </div>
</form>
</body>
</html>